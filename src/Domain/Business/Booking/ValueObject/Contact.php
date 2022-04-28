<?php

namespace Domain\Business\Booking\ValueObject; 

enum ContactType {
    case PHONE_NUMBER;
    case EMAIL;
}

final class Contact {
    public function __construct(
        public ContactType $type,
        public string $value
    )
    {
        
    }
}