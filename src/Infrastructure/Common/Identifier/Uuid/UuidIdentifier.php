<?php

namespace Infrastructure\Common\Identifier\Uuid;

use Domain\Utils\Identifier\Uuid\UuidIdentifierInterface;
use LogicException;
use Symfony\Component\Uid\Uuid;

abstract class  UuidIdentifier implements UuidIdentifierInterface
{
    public function __construct(private string $uuid)
    {
        $this->uuid = Uuid::v4();
    }

    public function isValid(string $uuid): bool
    {
        return Uuid::v4()::isValid($uuid);
    }

    abstract static function generate(): UuidIdentifierInterface;
    
    public function fromString(string $uuid): UuidIdentifierInterface
    {
        if (self::isValid($uuid)) {
            return new((string)Uuid::v4()::fromString($uuid));
        }
        throw new LogicException("$uuid is not a valid uuid");
    }

    public function __toString(): string
    {
        return $this->uuid;
    }

    public function jsonSerialize(): string
    {
        return $this->uuid;
    }
}
