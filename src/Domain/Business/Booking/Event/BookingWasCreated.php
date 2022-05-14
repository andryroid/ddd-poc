<?php

namespace Domain\Business\Booking\Event;

use Domain\Utils\Message\Attributes\AsDomainEvent;
use Domain\Utils\Message\MessageInterface;

#[AsDomainEvent]
final class BookingWasCreated implements MessageInterface
{
    public function __construct(
        private readonly string $identifierId
    ) {
    }
}
