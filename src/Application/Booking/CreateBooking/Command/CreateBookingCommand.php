<?php

namespace Application\Booking\CreateBooking\Command;

use Domain\Business\Booking\Collection\ContactsInterface;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Utils\Identifier\IndentifierInterface;

final class CreateBookingCommand
{
    public static IndentifierInterface $indentifierInterface;
    public static  Person $person;
    public static  ContactsInterface $contacts;
    public static  Location $departure;
    public static  Location $destination;
    public static  \DateTime $departureTime;
    
    public static function createBooking(
        IndentifierInterface $indentifierInterface,
        object $bookingData
    ): void 
    {
        self::$indentifierInterface = $indentifierInterface;
        //setup person
        self::$person = Person::build(
            $bookingData->person->first_name,
            $bookingData->person->last_name,
        );
        //setup contacts
        self::$contacts = $bookingData->contacts;
        //setup location
        self::$departure = Location::build($bookingData->departure);
        //setup destination
        self::$destination = Location::build($bookingData->destination);
        //add departure time
        self::$departureTime = $bookingData->departureTime;
    }
}
