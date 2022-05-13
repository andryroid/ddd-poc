<?php

namespace Domain\Business\Booking\Repository;

use Domain\Business\Booking\Model\Booking;
use Domain\Business\Booking\Model\Properties\BookingId;

interface BookingRepositoryInterface
{

    public function save(Booking $booking): BookingId;

}
