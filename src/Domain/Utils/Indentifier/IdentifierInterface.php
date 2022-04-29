<?php

namespace Domain\Utils\Identifier;

interface IndentifierInterface 
{
    public function isValidIdentifier(): bool;
    public function getIdentifier(): string;
}