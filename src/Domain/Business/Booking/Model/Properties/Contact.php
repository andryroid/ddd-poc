<?php

namespace Domain\Business\Booking\Model\Properties;

use Domain\Business\Booking\Exception\InvalidContactTypeException;

final class Contact
{
    private function __construct(
        public ContactType $type,
        public string $value
    ) {
    }

    public static function build(ContactType $type, string $value): self
    {
        if (!$type->isValidValue($value)) {
            throw new InvalidContactTypeException("contact $value is not a valid $type->value");
        }
        return new self(type: $type, value: $value);
    }
}
