<?php

namespace Domain\Business\Booking\Event;

final class BookingWasCreated {
    public function __construct(
        private readonly string $identifierId
    )
    {
        
    }
}
