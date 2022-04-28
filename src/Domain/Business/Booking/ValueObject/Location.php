<?php

namespace Domain\Business\Booking\ValueObject;

final class Location {
    public function __construct(
        public string $locationId,
        public string $locationName
    )
    {
        
    }
}