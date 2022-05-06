<?php

namespace Domain\Business\Booking\Model\Properties;

use Domain\Business\Booking\Exception\InvalidPersonException;

final class Person
{
    private function __construct(
        public string $firstName,
        public string $lastName
    ) {
    }

    public static function build(string $firstName, string $lastName): self
    {
        if (empty($firstName) || empty($lastName)) {
            throw new InvalidPersonException("Person information are missing");
        }

        return new self(firstName: $firstName, lastName: $lastName);
    }

}
