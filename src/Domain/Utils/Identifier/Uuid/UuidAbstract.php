<?php

namespace Domain\Utils\Identifier\Uuid;


use Symfony\Component\Uid\Uuid;

abstract class UuidAbstract implements UuidIdentifierInterface
{
    public function __construct(private string $uuid)
    {
    }

    public static function isValid(string $uuid): bool
    {
        return (Uuid::v4())::isValid($uuid);
    }

    public static function generate(): UuidIdentifierInterface
    {
        return new static(Uuid::v4()->jsonSerialize());
    }

    public static function fromString(string $uuid): UuidIdentifierInterface
    {
        return new static(Uuid::v4()::fromString($uuid));
    }

    public function isEquals(UuidIdentifierInterface $uuid): bool
    {
        return (Uuid::v4())->equals((string)$uuid);
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
