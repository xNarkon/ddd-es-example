<?php
declare(strict_types=1);

namespace Landingi\SharedKernel\EventSourcing;

use Landingi\SharedKernel\BuildingBlocks\AggregateId;
use Landingi\SharedKernel\BuildingBlocks\DomainEvent;
use Landingi\SharedKernel\Clock;

final class EventRecorder
{
    private Clock $clock;

    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    public function record(AggregateId $aggregateId, DomainEvent $event): RecordedEvent
    {
        return new RecordedEvent($aggregateId, $event, $this->clock->now());
    }
}
