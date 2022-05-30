<?php

namespace Infrastructure\Entity\Transofmer;

use Application\Booking\Transformer\BookingTransformerInterface;
use Domain\Business\Booking\Model\Booking as DomainBooking;
use Infrastructure\Entity\Booking\Booking as InfrastructureBooking;

class BookingTransformer implements BookingTransformerInterface
{
    public function fromDomainToDb(DomainBooking $domainBooking): InfrastructureBooking
    {
        return (new InfrastructureBooking());
    }
}
