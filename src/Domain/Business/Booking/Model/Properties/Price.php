<?php

namespace Domain\Business\Booking\Model\Properties;

class Price
{
    public function __construct(
        public readonly string $currency,
        public readonly float $amount
    ) {
    }

    public static function build(string $currency, float $amount): self
    {
        return new self(
            currency: $currency,
            amount: $amount
        );
    }
}
