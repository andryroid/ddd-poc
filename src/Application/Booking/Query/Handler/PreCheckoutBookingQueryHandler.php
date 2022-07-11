<?php

namespace Application\Booking\Query\Handler;


use Application\Booking\Query\PreCheckoutBookingQuery;
use Application\DTO\Booking\Contacts;
use Application\Shared\Message\Handler\QueryHandlerInterface;
use Domain\Business\Booking\Exception\BookingUnavailableException;
use Domain\Business\Booking\Model\Booking;
use Domain\Business\Booking\Model\Properties\Contact;
use Domain\Business\Booking\Model\Properties\ContactType;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Business\Booking\Repository\BookingAvailability;
use Domain\Business\Booking\Service\BookingPriceCalculation;

class PreCheckoutBookingQueryHandler implements QueryHandlerInterface
{
    private function __construct(
        private readonly BookingAvailability $bookingAvailability,
        private readonly BookingPriceCalculation $bookingPriceCalculation
    )
    {
    }

    public function __invoke(PreCheckoutBookingQuery $query): array
    {
        $booking = Booking::create(
            uuid: $query->uuid,
            bookingPriceCalculation: $this->bookingPriceCalculation,
            person: Person::build(firstName: $query->firstName, lastName: $query->lastName),
            contacts: $this->manageContacts($query->contacts),
            departure: Location::build($query->departure),
            destination: Location::build($query->destination),
            departureTime: new DateTime($query->departureTime),
            seatNumber: $query->seatNumber
        );
        //check availability
        if (!$this->bookingAvailability->isAvailable($booking))
            throw new BookingUnavailableException("Booking no longer available");
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