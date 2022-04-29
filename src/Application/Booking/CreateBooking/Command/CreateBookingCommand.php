<?php

namespace Application\Booking\CreateBooking\Command;

use Domain\Business\Booking\Collection\ContactsInterface;
use Domain\Business\Booking\Model\Booking;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Utils\Identifier\IndentifierInterface;

final class CreateBookingCommand
{
    public function __construct(
        public readonly Person $person,
        public readonly ContactsInterface $contacts,
        public readonly Location $departure,
        public readonly Location $destination,
        public readonly \DateTime $departureTime
    )
    {
        
    }
    
}
