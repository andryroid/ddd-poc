<?php

namespace Domain\Utils\AggregateRoot;

abstract class AggregateRoot {
    protected static array $events;
    protected function addEvent(object $event) : mixed {
        self::$events[] = $event;
    }
}