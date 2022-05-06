<?php

namespace Domain\Utils\Identifier;

interface IndentifierInterface 
{
    public function isValidIdentifier(string $identifier): bool;
    public function getIdentifier(): string;
}