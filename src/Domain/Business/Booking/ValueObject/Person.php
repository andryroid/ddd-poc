<?php
namespace Domain\Business\Booking\ValueObject;

final class Person {
    public function __construct(
        public string $firstName,
        public string $lastName
    )
    {
        
    }
}