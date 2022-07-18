<?php

namespace Infrastructure\Service\Transformer\Booking;

use Application\Booking\Transformer\BookingTransformerInterface;
use Application\DTO\Booking\Contacts;
use Domain\Business\Booking\Model\Booking as DomainBooking;
use Infrastructure\Entity\Booking\Booking as EntityBooking;

final class BookingTransformer implements BookingTransformerInterface
{
    public function fromDomainToDb(DomainBooking $domainBooking, ?EntityBooking $entityBooking = null): EntityBooking
    {
        return ($entityBooking ?? new EntityBooking())
            ->setUuid((string)$domainBooking->getUuid())
            ->setPerson(
                [
                    'firstName' => $domainBooking->getPerson()->firstName,
                    'lastName' => $domainBooking->getPerson()->lastName
                ]
            )
            ->setContacts(
                array_map(
                    fn(Contacts $contact) => $contact->toArray(),
                    $domainBooking->getContacts()->toArray()
                )
            )
            ->setDeparture($domainBooking->getDeparture()->locationName)
            ->setDestination($domainBooking->getDestination()->locationName)
            ->setBookedAt($domainBooking->getBookedAt())
            ->setSeatNumber($domainBooking->getSeatNumber())
            ->setDepartureAt($domainBooking->getDepartureTime());
    }
}
