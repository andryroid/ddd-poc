<?php

namespace Application\Booking\CreateBooking\Command;

use Domain\Business\Booking\Collection\ContactsInterface;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Utils\Identifier\IndentifierInterface;

final class CreateBookingCommand
{
    public function __construct(
        public readonly IndentifierInterface $indentifierInterface,
        public readonly  Person $person,
        public readonly  ContactsInterface $contacts,
        public readonly  Location $departure,
        public readonly  Location $destination,
        public readonly  \DateTime $departureTime
    )
    {
        
    }
    
    public static function createBooking(
        IndentifierInterface $indentifierInterface,
        object $bookingData
    ): self 
    {
        return new CreateBookingCommand(
            $indentifierInterface,
            Person::build(
                $bookingData->person->first_name,
                $bookingData->person->last_name,
            ),
            $bookingData->contacts,
            Location::build($bookingData->departure),
            Location::build($bookingData->destination),
            $bookingData->departureTime
        );
    }
}
