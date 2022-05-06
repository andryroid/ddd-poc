<?php

namespace Application\Booking\CreateBooking\Handler;

use Application\Booking\CreateBooking\Command\CreateBookingCommand;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateBookingCommandHandler implements MessageHandlerInterface
{
    public function __invoke(CreateBookingCommand $createBookingCommand)
    {
        
    }
}