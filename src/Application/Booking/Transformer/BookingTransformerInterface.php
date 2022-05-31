<?php

namespace Application\Booking\Transformer;

use Domain\Business\Booking\Model\Booking as DomainBooking;
use Infrastructure\Entity\Booking\Booking as EntityBooking;

interface BookingTransformerInterface
{
    public function fromDomainToDb(DomainBooking $domainBooking): EntityBooking;
}
