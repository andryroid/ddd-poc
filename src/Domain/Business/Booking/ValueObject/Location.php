<?php

namespace Domain\Business\Booking\ValueObject;

final class Location {
    public function __construct(
        public string $locationId,
        public string $locationName
    )
    {
        
    }

    public function isTheSameLocation(Location $ohterLocation) : bool {
        return 
            $this->locationId === $ohterLocation->locationId 
            && 
            $this->locationName === $ohterLocation->locationName;
    }
}