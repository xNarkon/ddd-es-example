<?php
declare(strict_types=1);

namespace Landingi\SharedKernel\EventSourcing;

use ArrayIterator;
use Exception;
use Traversable;

final class MutableEventStream implements \IteratorAggregate
{
    private array $events;

    public function __construct()
    {
        $this->events = [];
    }

    public function add(RecordedEvent $recordedEvent): void
    {
        $this->events[] = $recordedEvent;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->events);
    }
}
