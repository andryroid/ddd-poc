<?php

namespace Application\Booking\Query\Handler;

use Application\Booking\Query\CheckBookingQuery;
use Application\DTO\Booking\Contacts;
use Application\Shared\Message\Handler\QueryHandlerInterface;
use Domain\Business\Booking\Model\Booking;
use Domain\Business\Booking\Model\Properties\Contact;
use Domain\Business\Booking\Model\Properties\ContactType;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Business\Booking\Service\BookingPriceCalculation;

class CheckBookingQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly BookingPriceCalculation $bookingPriceCalculation
    )
    {
    }

    public function __invoke(CheckBookingQuery $bookingQuery) : array
    {
        $booking = Booking::create(
            uuid: $bookingQuery->uuid,
            bookingPriceCalculation: $this->bookingPriceCalculation,
            person: Person::build(firstName: $bookingQuery->firstName, lastName: $bookingQuery->lastName),
            contacts: $this->manageContacts($bookingQuery->contacts),
            departure: Location::build($bookingQuery->departure),
            destination: Location::build($bookingQuery->destination),
            departureTime: new DateTime($bookingQuery->departureTime),
            seatNumber: $bookingQuery->seatNumber
        );

        return $booking->getSummary();
    }

    private function manageContacts(Contacts $contacts): Contacts
    {
        $contacts = $contacts->toArray();
        return new Contacts(
            array_map(
                fn(object $item) => Contact::build(type: ContactType::build($item->type), value: $item->value),
                $contacts
            )
        );
    }
}