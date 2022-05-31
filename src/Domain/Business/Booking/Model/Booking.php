<?php

namespace Domain\Business\Booking\Model;

use Domain\Business\Booking\Collection\ContactsInterface;
use Domain\Business\Booking\Event\BookingWasCreated;
use Domain\Business\Booking\Exception\EmptyContactsException;
use Domain\Business\Booking\Exception\InvalidBoookingDateException;
use Domain\Business\Booking\Exception\InvalidDepartureException;
use Domain\Business\Booking\Model\Properties\BookingId;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Utils\AggregateRoot\AggregateRoot;
use Domain\Utils\Identifier\Uuid\UuidIdentifierInterface;

final class Booking extends AggregateRoot
{

    private function __construct(
        private UuidIdentifierInterface $uuid,
        private Person $person,
        private ContactsInterface $contacts,
        private Location $departure,
        private Location $destination,
        private \DateTime $departureTime
    ) {
    }

    public static function create(
        UuidIdentifierInterface $uuid,
        Person $person,
        ContactsInterface $contacts,
        Location $departure,
        Location $destination,
        \DateTime $departureTime
    ): self {
        if ($contacts->isEmpty()) {
            throw new EmptyContactsException("You need to specify at least one contact information");
        }
        if ($departure->isEqual($destination)) {
            throw new InvalidDepartureException("Destination is equal to Departure");
        }
        //Cannot book a trip in the past
        if (new \DateTime() > $departureTime) {
            throw new InvalidBoookingDateException("Destination is equal to Departure");
        }

        $booking = new self(
            uuid: $uuid,
            person: $person,
            contacts: $contacts,
            departure: $departure,
            destination: $destination,
            departureTime: $departureTime,
        );
        $booking->addEvent(new BookingWasCreated($booking->uuid->generate()));

        return $booking;
    }

    /**
     * @return BookingId
     */
    public function getUuid(): BookingId
    {
        return $this->uuid;
    }

    public function getSummary(): array
    {
        return [
            "uuid" => $this->uuid,
            "person" => [
                "first_name" => $this->person->firstName,
                "last_name" => $this->person->lastName
            ],
            "contacts" => $this->contacts,
            "departure" => $this->departure->locationName,
            "destination" => $this->destination->locationName,
            "departure_time" => $this->departureTime->format
        ];
    }
}
