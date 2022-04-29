<?php

namespace Domain\Utils\AggregateRoot;

class AggregateRoot {
    protected array $events;
    protected function addEvent(object $event) : mixed {
        $this->events[] = $event;
    }
}