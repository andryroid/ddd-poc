<?php

namespace Domain\Business\Booking\Model\Properties;

enum ContactType: string
{
    case PHONE_NUMBER = 'phoneNumber';
    case EMAIL = 'email';

    public static function build(string $type): self
    {
        return match ($type) {
            self::PHONE_NUMBER->value => ContactType::PHONE_NUMBER,
            self::EMAIL->value => ContactType::EMAIL,
        };
    }

    public function isValidValue(string $value): bool
    {
        return match ($this) {
            self::EMAIL => (bool)filter_var($value, FILTER_VALIDATE_EMAIL),
            self::PHONE_NUMBER => is_string($value) //todo add business logic for phone number
        };
    }
}
