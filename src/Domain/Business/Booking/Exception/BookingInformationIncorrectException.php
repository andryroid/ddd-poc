<?php

namespace Domain\Business\Booking\Exception;

final class BookingInformationIncorrectException extends \Exception {
    public function __construct(
        private $errorMessage
    )
    {
        parent::__construct($this->errorMessage);        
    }
}