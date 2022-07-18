<?php

namespace Application\Booking\Command;

use Application\DTO\Booking\Contacts;
use Application\Shared\Message\FromArrayableInterface;
use Domain\Business\Booking\Collection\ContactsInterface;
use Domain\Utils\Message\Attributes\AsCommand;
use Domain\Utils\Message\MessageInterface;
use InvalidArgumentException;
use stdClass;

#[AsCommand]
final class CreateBookingCommand implements MessageInterface, FromArrayableInterface
{
    private function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly ContactsInterface $contacts,
        public readonly string $departure,
        public readonly string $destination,
        public readonly string $departureTime,
        public readonly int $seatNumber
    ) {
    }

    public static function fromArray(array $data): self
    {
        //todo use array instead of stdclass , the method name is fromArray
        $data = (object)$data;
        //check data first
        self::validateMetadata($data);
        //check availability
        return new self(
            firstName: $data->firstName,
            lastName: $data->lastName,
            contacts: new Contacts($data->contacts),
            departure: $data->departure,
            destination: $data->destination,
            departureTime: $data->departureTime,
            seatNumber: $data->seatNumber
        );
    }

    private static function validateMetadata(stdClass $data): void
    {
        if (empty($data->firstName)) {
            throw new InvalidArgumentException('Fist name');
        }
        if (empty($data->lastName)) {
            throw new InvalidArgumentException('Last name');
        }
        if (empty($data->departure)) {
            throw new InvalidArgumentException('Departure invalid');
        }
        if (empty($data->destination)) {
            throw new InvalidArgumentException('Destination invalid');
        }
        if (empty($data->departureTime)) {
            throw new InvalidArgumentException('Departure time invalid');
        }
        if (empty($data->seatNumber)) {
            throw new InvalidArgumentException('Seat number invalid');
        }
        if (!is_array($data->contacts)) {
            throw new InvalidArgumentException('invalid contact : array of string');
        }
    }
}
