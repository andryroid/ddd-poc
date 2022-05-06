<?php

namespace Application\Booking\CreateBooking\Command;

use Domain\Business\Booking\Collection\ContactsInterface;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Utils\Identifier\IndentifierInterface;

final class CreateBookingCommand
{
    public readonly IndentifierInterface $indentifierInterface;
    public readonly Person $person;
    public readonly ContactsInterface $contacts;
    public readonly Location $departure;
    public readonly Location $destination;
    public readonly \DateTime $departureTime;
    
    public function createBooking(
        IndentifierInterface $indentifierInterface,
        object $bookingData
    ): void 
    {
        $this->indentifierInterface = $indentifierInterface;
        //setup person
        $this->person = Person::build(
            $bookingData->person->first_name,
            $bookingData->person->last_name,
        );
        //setup contacts
        $this->contacts = $bookingData->contacts;
        //setup location
        $this->departure = Location::build($bookingData->departure);
        //setup destination
        $this->destination = Location::build($bookingData->destination);
        //add departure time
        $this->departureTime = $bookingData->departureTime;
    }
}
