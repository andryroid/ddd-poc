<?php

namespace Infrastructure\Service\Transformer\Booking;

use Application\Booking\Transformer\BookingTransformerInterface;
use Application\DTO\Booking\Contacts;
use Domain\Business\Booking\Model\Booking as DomainBooking;
use Infrastructure\Entity\Booking\Booking as EntityBooking;

final class BookingTransformer implements BookingTransformerInterface 
{
    public function fromDomainToDb(DomainBooking $domainBooking): EntityBooking 
    {
        $dataFromDomain  = $domainBooking->getSummary();
        return (new EntityBooking())
            ->setUuid($dataFromDomain['uuid'])
            ->setPerson($dataFromDomain['person'])
            ->setContacts(array_map(fn(Contacts $contact) => $contact->toArray(),$dataFromDomain['contacts']))
            ->setDeparture($dataFromDomain['departure'])
            ->setDestination($dataFromDomain['destination'])
            ->setDepartureAt($dataFromDomain['departure_at']);
    }
}