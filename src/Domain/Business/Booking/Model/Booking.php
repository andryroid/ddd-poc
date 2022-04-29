<?php

namespace Domain\Business\Booking\Model;

use Domain\Business\Booking\Collection\ContactsInterface;
use Domain\Business\Booking\Exception\EmptyContactsException;
use Domain\Business\Booking\Exception\InvalidBoookingDateException;
use Domain\Business\Booking\Exception\InvalidDepartureException;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Utils\AggregateRoot\AggregateRoot;

final class Booking extends AggregateRoot
{

    private function __construct(
        private Person $person,
        private ContactsInterface $contacts,
        private Location $departure,
        private Location $destination,
        private \DateTime $departureTime
    ) {
    }

    public static function create(
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
            person: $person,
            contacts: $contacts,
            departure: $departure,
            destination: $destination,
            departureTime: $departureTime,
        );

        //todo record event here

        return $booking;
    }
}
