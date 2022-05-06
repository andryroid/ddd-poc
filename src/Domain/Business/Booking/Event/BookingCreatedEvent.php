<?php

namespace Domain\Business\Booking\Event;

final class BookingCreatedEvent {
    public function __construct(
        private readonly string $identifierId
    )
    {
        
    }
}