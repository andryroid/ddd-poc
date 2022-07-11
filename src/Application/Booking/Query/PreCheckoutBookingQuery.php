<?php

namespace Application\Booking\Query;

use Application\DTO\Booking\Contacts;
use Domain\Business\Booking\Collection\ContactsInterface;
use Domain\Utils\Identifier\Uuid\UuidIdentifierInterface;
use Domain\Utils\Message\Attributes\AsQuery;

#[AsQuery]
class PreCheckoutBookingQuery
{
    private function __construct(
        public readonly UuidIdentifierInterface $uuid,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly ContactsInterface $contacts,
        public readonly string $departure,
        public readonly string $destination,
        public readonly string $departureTime,
        public readonly int $seatNumber,
        public float $amountPrice = 0
    )
    {
    }

    public static function fromArray(UuidIdentifierInterface $uuid, stdClass $data): self
    {
        //check data first
        self::validateMetadata($data);
        //check availability
        return new self(
            uuid: $uuid,
            firstName: $data->firstName,
            lastName: $data->lastName,
            contacts: new Contacts($data->contacts),
            departure: $data->departure,
            destination: $data->destination,
            departureTime: $data->departureTime,
            seatNumber: $data->seatNumber
        );
    }

    public function presentData() : array
    {
        return [
            "departure" =>  $this->departure,
            "destination" => $this->destination,
            "seat_number" => $this->seatNumber,
            "departure_time" => $this->departureTime,
            "price" => $this->amountPrice
        ];
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