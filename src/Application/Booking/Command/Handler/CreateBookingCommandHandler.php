<?php

namespace Application\Booking\Command\Handler;

use Application\Booking\Command\CreateBookingCommand;
use Application\DTO\Booking\Contacts;
use Application\Shared\Message\Handler\CommandHandlerInterface;
use DateTime;
use Domain\Business\Booking\Exception\BookingUnavailableException;
use Domain\Business\Booking\Model\Booking;
use Domain\Business\Booking\Model\Properties\BookingId;
use Domain\Business\Booking\Model\Properties\Contact;
use Domain\Business\Booking\Model\Properties\ContactType;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Business\Booking\Repository\BookingAvailability;
use Domain\Business\Booking\Repository\BookingRepositoryInterface;
use Domain\Utils\Event\EventManagerInterface;

final class CreateBookingCommandHandler implements CommandHandlerInterface
{

    public function __construct(
        private readonly EventManagerInterface $eventManager,
        private readonly BookingRepositoryInterface $bookingRepository,
        private readonly BookingAvailability $bookingAvailability
    ) {
    }

    public function __invoke(CreateBookingCommand $command): BookingId
    {
        $booking = Booking::create(
            uuid: $command->uuid,
            person: Person::build(firstName: $command->firstName, lastName: $command->lastName),
            contacts: $this->manageContacts($command->contacts),
            departure: Location::build($command->departure),
            destination: Location::build($command->destination),
            departureTime: new DateTime($command->departureTime),
            seatNumber: $command->seatNumber
        );
        //check availability
        if (!$this->bookingAvailability->isAvailable($booking))
            throw new BookingUnavailableException("Booking unavailable");
        $this->eventManager->persist($booking);
        return $this->bookingRepository->save($booking);
    }

    private function manageContacts(Contacts $contacts): Contacts
    {
        $contacts = $contacts->toArray();
        return new Contacts(
            array_map(
                fn(object $item) => Contact::build(type: ContactType::build($item->type), value: $item->value),
                $contacts
            )
        );
    }
}
