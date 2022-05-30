<?php

namespace Infrastructure\Service\Transformer\Booking;

use Application\Booking\Transformer\BookingTransformerInterface;
use Domain\Business\Booking\Model\Booking as DomainBooking;
use Infrastructure\Entity\Booking\Booking as InfrastructureBooking;

final class BookingTransformer implements BookingTransformerInterface
{
    public function __construct()
    {
        
    }
    public function fromDomainToDb(DomainBooking $domainBooking): InfrastructureBooking
    {
        return (new InfrastructureBooking());
    }
}
