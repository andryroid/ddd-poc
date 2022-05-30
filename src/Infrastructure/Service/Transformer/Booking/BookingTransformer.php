<?php

namespace Infrastructure\Service\Transformer\Booking;

use Application\Booking\Transformer\BookingTransformerInterface;
use Domain\Utils\Entity\EntityInterface;
use Domain\Business\Booking\Model\Booking as DomainBooking;

final class BookingTransformer implements BookingTransformerInterface 
{
    public function fromDomainToDb(DomainBooking $domainBooking): string 
    {
        return "";
    }
}