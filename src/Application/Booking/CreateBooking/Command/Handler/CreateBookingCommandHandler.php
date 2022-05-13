<?php

namespace Application\Booking\CreateBooking\Command\Handler;

use Application\Booking\CreateBooking\Command\CreateBookingCommand;
use Application\Shared\Handler\HandlerInterface;
use DateTime;
use Domain\Business\Booking\Model\Booking;
use Domain\Business\Booking\Model\Properties\BookingId;
use Domain\Business\Booking\Model\Properties\Location;
use Domain\Business\Booking\Model\Properties\Person;
use Domain\Business\Booking\Repository\BookingRepositoryInterface;
use Domain\Utils\Event\EventManagerInterface;

final class CreateBookingCommandHandler implements HandlerInterface
{

    private function __construct(
        private readonly EventManagerInterface $eventManager,
        private readonly BookingRepositoryInterface $bookingRepository
    ) {
    }

    public function __invoke(CreateBookingCommand $command): BookingId
    {
        $booking = Booking::create(
            uuid: $command->uuid,
            person: Person::build(firstName: $command->firstName, lastName: $command->lastName),
            contacts: $command->contacts,
            departure: Location::build($command->departure),
            destination: Location::build($command->destination),
            departureTime: new DateTime($command->departureTime)
        );

        $this->eventManager->persist($booking);

        return $this->bookingRepository->save($booking);
    }
}
