<?php

namespace Infrastructure\Common\Identifier\Uuid\Booking;

use Domain\Business\Booking\Model\Properties\BookingId;
use Domain\Utils\Identifier\Uuid\UuidIdentifierInterface;
use Infrastructure\Common\Identifier\Uuid\UuidIdentifier;

final class BookingIdentifier extends UuidIdentifier implements BookingId
{
    private const PREFIX = "bkn";
    public static function generate(): UuidIdentifierInterface
    {
        return new self(self::PREFIX);
    }
}
