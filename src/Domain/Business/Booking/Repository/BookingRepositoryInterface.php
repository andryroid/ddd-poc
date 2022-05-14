<?php

namespace Domain\Business\Booking\Repository;

use Domain\Business\Booking\Model\Booking as DomainBooking;
use Domain\Business\Booking\Model\Properties\BookingId;

interface BookingRepositoryInterface
{

    public function save(DomainBooking $domainBooking): BookingId;

}
