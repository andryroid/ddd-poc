<?php

namespace Domain\Business\Booking\Service;

use Domain\Business\Booking\Model\Booking;
use Domain\Business\Booking\Model\Properties\Price;

interface BookingPriceCalculation
{
    public function calculatePrice(Booking $booking): Price;
    public function getPriceDetails(): Price;
}