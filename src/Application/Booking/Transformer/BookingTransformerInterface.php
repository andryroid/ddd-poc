<?php

namespace Application\Booking\Transformer;

use Domain\Business\Booking\Model\Booking as DomainBooking;
use Infrastructure\Entity\Booking\Booking; //todo find a way to remove this

interface BookingTransformerInterface
{
    public function fromDomainToDb(DomainBooking $domainBooking): Booking;
}
