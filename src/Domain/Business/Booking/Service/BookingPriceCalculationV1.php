<?php

namespace Domain\Business\Booking\Service;

use Domain\Business\Booking\Model\Booking;
use Domain\Business\Booking\Model\Properties\Price;

class BookingPriceCalculationV1 implements BookingPriceCalculation
{

    public function calculatePrice(Booking $booking): Price
    {
        return Price::build("Ariary",30000);
    }
}