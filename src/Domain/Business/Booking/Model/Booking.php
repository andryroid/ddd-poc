<?php

namespace Domain\Business\Booking\Model;

use Domain\Business\Booking\Collection\ContactsInterface;
use Domain\Business\Booking\Event\BookingWasCreated;
use Domain\Business\Booking\Exception\InvalidPriceException;
use Domain\Business\Booking\Exception\EmptyContactsException;
use Domain\Business\Booking\Exception\InvalidBoookingDateException;
use Domain\Business\Booking\Exception\BookingUnavailableException;
use Domain\Business\Booking\Exception\InvalidSeatNumberException;
use Domain\Business\Booking\Model\Properties\BookingId;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Business\Booking\Model\Properties\Price;
use Domain\Business\Booking\Service\BookingPriceCalculation;
use Domain\Utils\AggregateRoot\AggregateRoot;
use Domain\Utils\Identifier\Uuid\UuidIdentifierInterface;
use JetBrains\PhpStorm\ArrayShape;

final class Booking extends AggregateRoot
{

    private function __construct(
        private UuidIdentifierInterface $uuid,
        private Price $price,
        private Person $person,
        private ContactsInterface $contacts,
        private Location $departure,
        private Location $destination,
        private \DateTime $departureTime,
        private \DateTimeImmutable $bookedAt,
        private int $seatNumber
    ) {
    }

    public static function create(
        UuidIdentifierInterface $uuid,
        BookingPriceCalculation $bookingPriceCalculation,
        Person $person,
        ContactsInterface $contacts,
        Location $departure,
        Location $destination,
        \DateTime $departureTime,
        int $seatNumber
    ): self {
        if ($contacts->isEmpty()) {
            throw new EmptyContactsException("You need to specify at least one contact information");
        }
        if ($departure->isEqual($destination)) {
            throw new BookingUnavailableException("Destination cannot be equal to Departure");
        }
        //Cannot book a trip in the past
        if (new \DateTime() > $departureTime) {
            throw new InvalidBoookingDateException("Cannot book a trip in the past");
        }
        //check place number
        if ($seatNumber <=0)
            throw new InvalidSeatNumberException("Invalid seat number");
        if (!isset($price))
            throw new InvalidPriceException("Invalid price");

        $booking = new self(
            uuid: $uuid,
            price: $bookingPriceCalculation->calculatePrice(),
            person: $person,
            contacts: $contacts,
            departure: $departure,
            destination: $destination,
            departureTime: $departureTime,
            bookedAt: \DateTimeImmutable::createFromMutable(new \DateTime()),
            seatNumber: $seatNumber
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
            "departure_time" => $this->departureTime,
            "booked_at" => $this->bookedAt,
            "seat_number" => $this->seatNumber,
            "price" => $this->price
        ];
    }
}
