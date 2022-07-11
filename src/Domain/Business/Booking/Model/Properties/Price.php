<?php

namespace Domain\Business\Booking\Model\Properties;

class Price
{
    public function __construct(
        private readonly string $currency,
        private readonly float $amount
    )
    {
    }
    public static function build(string $currency, float $amount) : self
    {
        return new self(
            currency: $currency,
            amount: $amount
        );
    }

    public function getDetails() : array {
        return [
            "currency" => $this->currency,
            "amount" => $this->amount
        ];
    }
}