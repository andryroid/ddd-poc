<?php

namespace Domain\Utils\Identifier\Uuid;

use JsonSerializable;
use Stringable;

interface UuidIdentifierInterface extends JsonSerializable, Stringable
{
    public static function isValid(string $uuid): bool;
    public static function generate(): UuidIdentifierInterface;
    public static function fromString(string $uuid): UuidIdentifierInterface;
    public function getStringValue():string;
}
