<?php

namespace Domain\Utils\Identifier\Uuid;

use JsonSerializable;
use Stringable;

interface UuidIdentifierInterface extends JsonSerializable, Stringable
{
    public  function isValid(string $uuid): bool;
    public static function generate(): UuidIdentifierInterface;
    public  function fromString(string $uuid): UuidIdentifierInterface;
}
