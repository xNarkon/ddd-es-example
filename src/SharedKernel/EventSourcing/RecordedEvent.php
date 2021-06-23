<?php
declare(strict_types=1);

namespace Landingi\SharedKernel\EventSourcing;

use DateTimeImmutable;
use DateTimeInterface;
use Landingi\SharedKernel\BuildingBlocks\AggregateId;
use Landingi\SharedKernel\BuildingBlocks\DomainEvent;

final class RecordedEvent
{
    private AggregateId $aggregateId;
    private DomainEvent $payload;
    private DateTimeInterface $occurredOn;

    public function __construct(
        AggregateId $aggregateId,
        DomainEvent $payload,
        DateTimeInterface $occurredOn
    ) {
        $this->aggregateId = $aggregateId;
        $this->payload = $payload;
        $this->occurredOn = $occurredOn;
    }

    public function getAggregateId(): AggregateId
    {
        return $this->aggregateId;
    }

    public function getPayload(): DomainEvent
    {
        return $this->payload;
    }

    public function getOccurredOn(): DateTimeInterface
    {
        return $this->occurredOn;
    }
}
