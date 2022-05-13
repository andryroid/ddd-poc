<?php

namespace Application\Booking\CreateBooking\Command;

use Application\DTO\Booking\Contacts;
use Domain\Business\Booking\Collection\ContactsInterface;
use Domain\Utils\Identifier\Uuid\UuidIdentifierInterface;
use InvalidArgumentException;

final class CreateBookingCommand
{
    private function __construct(
        public readonly UuidIdentifierInterface $uuid,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly ContactsInterface $contacts,
        public readonly string $departure,
        public readonly string $destination,
        public readonly string $departureTime

    ) {
    }

    public static function fromArray(UuidIdentifierInterface $uuid, array $data): self
    {
        self::validate($data);

        return new self(
            uuid: $uuid,
            firstName: $data['firstName'],
            lastName: $data['lastName'],
            contacts: new Contacts($data['contacts']),
            departure: $data['departure'],
            destination: $data['destination'],
            departureTime: $data['departureTime']
        );
    }

    private static function validate(array $data): void
    {
        if (!isset(
            $data['firstName'],
            $data['lastName'],
            $data['contacts'],
            $data['departure'],
            $data['destination'],
            $data['departureTime']
        )) {
            throw new InvalidArgumentException('some data on payload missing');
        }
        if (!is_array($data['contacts'])) {
            throw new InvalidArgumentException('contacts should be an array');
        }
    }

}
