<?php

namespace Domain\Business\Booking\Repository;

use Domain\Business\Booking\Model\Booking;

interface BookingAvailability
{
    public function isAvailable(Booking $booking) : bool;
}