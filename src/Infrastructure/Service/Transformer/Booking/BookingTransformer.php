<?php

namespace Infrastructure\Service\Transformer\Booking;

use Application\Booking\Transformer\BookingTransformerInterface;
use Domain\Utils\Entity\EntityInterface;
use Domain\Business\Booking\Model\Booking as DomainBooking;
use Infrastructure\Entity\Booking\Booking as EntityBooking;

final class BookingTransformer implements BookingTransformerInterface 
{
    public function fromDomainToDb(DomainBooking $domainBooking): EntityInterface 
    {
        $dataFromDomain  = $domainBooking->getSummary();
        return (new EntityBooking())
            ->setUuid($dataFromDomain['uuid'])
            ->setPerson($dataFromDomain['person'])
            ->setContacts($dataFromDomain['contacts'])
            ->setDeparture($dataFromDomain['departure'])
            ->setDestination($dataFromDomain['destination'])
            ->setDepartureAt($dataFromDomain['departure_at']);
    }
}