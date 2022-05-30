<?php

namespace Application\Booking\Transformer;

use Domain\Business\Booking\Model\Booking as DomainBooking;
use Domain\Utils\Entity\EntityInterface;

interface BookingTransformerInterface
{
    public function fromDomainToDb(DomainBooking $domainBooking): EntityInterface;
}
