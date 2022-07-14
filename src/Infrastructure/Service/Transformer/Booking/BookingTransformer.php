<?php

namespace Infrastructure\Service\Transformer\Booking;

use Application\Booking\Transformer\BookingTransformerInterface;
use Domain\Business\Booking\Model\Booking as DomainBooking;
use Domain\Business\Booking\Model\Properties\Contact;
use Infrastructure\Entity\Booking\Booking as EntityBooking;

final class BookingTransformer implements BookingTransformerInterface 
{
    public function fromDomainToDb(DomainBooking $domainBooking): EntityBooking 
    {
        $dataFromDomain  = $domainBooking->getSummary();
        return (new EntityBooking())
            ->setUuid($dataFromDomain['uuid'])
            ->setPerson($dataFromDomain['person'])
            ->setContacts(array_map(fn(Contact $contact) => $contact->toArray(),$dataFromDomain['contacts']),true)
            ->setDeparture($dataFromDomain['departure'])
            ->setDestination($dataFromDomain['destination'])
            ->setBookedAt($dataFromDomain['booked_at'])
            ->setSeatNumber($dataFromDomain['seat_number'])
            ->setDepartureAt($dataFromDomain['departure_time']);
    }
}