<?php

namespace Domain\Business\Booking\Model\Properties;

final class Location
{
    private function __construct(
        public readonly string $locationName
    ) {
    }

    public static function build(string $locationName): self
    {
        return new self(locationName: $locationName);
    }

    public function isEqual(Location $otherLocation): bool
    {
        return $this->locationName === $otherLocation->locationName;
    }
}
