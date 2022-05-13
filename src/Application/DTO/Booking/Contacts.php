<?php

namespace Application\DTO\Booking;

use Domain\Business\Booking\Collection\ContactsInterface;

/*
we can use array collection of doctrine.
Advantage : we have many helper
Inconvenient :  we have library on our application
*/

class Contacts implements ContactsInterface
{

    private array $elements;

    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }

    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    public function contains(mixed $element): bool
    {
        return in_array($element, $this->elements);
    }

    public function count(): int
    {
        return count($this->elements);
    }

    public function toArray(): array
    {
        return $this->elements;
    }
}
