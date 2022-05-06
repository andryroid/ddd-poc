<?php

namespace Domain\Business\Booking\Model\Properties;

enum ContactType: string
{
    case PHONE_NUMBER = 'phone number';
    case EMAIL = 'email';

    public function isValidValue(string $value): bool
    {
        return match ($this) {
            self::EMAIL => (bool)filter_var($value, FILTER_VALIDATE_EMAIL),
            self::PHONE_NUMBER => is_string($value) //todo add business logic for phone number
        };
    }
}
