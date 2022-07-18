<?php

namespace Domain\Business\Booking\Model;

use DateTime;
use Domain\Business\Booking\Collection\ContactsInterface;
use Domain\Business\Booking\Event\BookingWasCreated;
use Domain\Business\Booking\Exception\BookingUnavailableException;
use Domain\Business\Booking\Exception\EmptyContactsException;
use Domain\Business\Booking\Exception\InvalidBoookingDateException;
use Domain\Business\Booking\Exception\InvalidPriceException;
use Domain\Business\Booking\Exception\InvalidSeatNumberException;
use Domain\Business\Booking\Model\Properties\BookingId;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Business\Booking\Model\Properties\Price;
use Domain\Utils\AggregateRoot\AggregateRoot;

final class Booking extends AggregateRoot
{

    private function __construct(
        private BookingId $uuid,
        private Price $price,
        private Person $person,
        private ContactsInterface $contacts,
        private Location $departure,
        private Location $destination,
        private DateTime $departureTime,
        private \DateTimeImmutable $bookedAt,
        private int $seatNumber
    ) {
    }

    public static function create(
        Person $person,
        ContactsInterface $contacts,
        Location $departure,
        Location $destination,
        DateTime $departureTime,
        Price $price,
        int $seatNumber
    ): self {
        if ($contacts->isEmpty()) {
            throw new EmptyContactsException("You need to specify at least one contact information");
        }
        if ($departure->isEqual($destination)) {
            throw new BookingUnavailableException("Destination cannot be equal to Departure");
        }
        //Cannot book a trip in the past
        if (new DateTime() > $departureTime) {
            throw new InvalidBoookingDateException("Cannot book a trip in the past");
        }
        //check place number
        if ($seatNumber <= 0) {
            throw new InvalidSeatNumberException("Invalid seat number");
        }
        if (!isset($price)) {
            throw new InvalidPriceException("Invalid price");
        }

        $booking = new self(
            uuid: BookingId::generate(),
            price: $price,
            person: $person,
            contacts: $contacts,
            departure: $departure,
            destination: $destination,
            departureTime: $departureTime,
            bookedAt: \DateTimeImmutable::createFromMutable(new DateTime()),
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

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @return ContactsInterface
     */
    public function getContacts(): ContactsInterface
    {
        return $this->contacts;
    }

    /**
     * @return Location
     */
    public function getDeparture(): Location
    {
        return $this->departure;
    }

    /**
     * @return Location
     */
    public function getDestination(): Location
    {
        return $this->destination;
    }

    /**
     * @return DateTime
     */
    public function getDepartureTime(): DateTime
    {
        return $this->departureTime;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBookedAt(): \DateTimeImmutable
    {
        return $this->bookedAt;
    }

    /**
     * @return int
     */
    public function getSeatNumber(): int
    {
        return $this->seatNumber;
    }
}
