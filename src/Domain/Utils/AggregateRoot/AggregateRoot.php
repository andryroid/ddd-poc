<?php

namespace Domain\Utils\AggregateRoot;

abstract class AggregateRoot
{
    protected array $events;

    protected function addEvent(object $event): static
    {
        $this->events[] = $event;
        return $this;
    }
}
