<?php

namespace Domain\Business\Booking\Service;

use Domain\Business\Booking\Model\Booking;

interface BookingAvailability
{
    public function isAvailable(Booking $booking) : bool;
}