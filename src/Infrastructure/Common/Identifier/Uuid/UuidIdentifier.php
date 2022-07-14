<?php

namespace Infrastructure\Common\Identifier\Uuid;

use Domain\Utils\Identifier\Uuid\UuidIdentifierInterface;
use LogicException;
use Symfony\Component\Uid\Uuid;

abstract class  UuidIdentifier implements UuidIdentifierInterface
{
    public function __construct(private ?string $uuid)
    {
        if (is_null($this->uuid))
        {
            $this->uuid = Uuid::v4();
        }
        else {
            $this->generateFromString($this->uuid);
        }
    }

    public static function isValid(string $uuid): bool
    {
        return Uuid::v4()::isValid($uuid);
    }

    abstract static function generate(): UuidIdentifierInterface;
    
    abstract static function fromString(string $uuid): UuidIdentifierInterface;

    public function __toString(): string
    {
        return $this->uuid;
    }

    public function jsonSerialize(): string
    {
        return $this->uuid;
    }

    private function generateFromString(string $uuid) : self
    {
        if (self::isValid($uuid)) {
            $this->uuid = new (Uuid::v4()::fromString($uuid));
            return $this;
        }
        throw new LogicException("$uuid is not a valid uuid");
    }

}
