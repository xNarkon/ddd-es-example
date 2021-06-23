<?php
declare(strict_types=1);

namespace Landingi\SharedKernel\EventSourcing;

use Landingi\SharedKernel\EventSourcing\Attributes\AppliesEvent;
use Landingi\SharedKernel\BuildingBlocks\AggregateRoot;
use Landingi\SharedKernel\BuildingBlocks\DomainEvent;
use Landingi\SharedKernel\EventSourcing\Exception\MissingEventApplyMethod;
use Landingi\SharedKernel\SystemClock;
use ReflectionMethod;
use ReflectionObject;

abstract class EventSourcedAggregateRoot implements AggregateRoot
{
    private ?EventRecorder $eventRecorder = null;
    private ?MutableEventStream $mutableEventStream = null;
    private int $version = 0;

    protected function recordThat(DomainEvent $domainEvent): void
    {
        $this->apply($domainEvent);
        $this->version++;

        $this->getEventStream()->add(
            $this->getEventRecorder()->record($this->getAggregateId(), $domainEvent)
        );
    }

    protected function apply(DomainEvent $domainEvent): void
    {
        $applyMethod = $this->getApplyMethod($domainEvent);

        if ($applyMethod === null) {
            throw MissingEventApplyMethod::createForEvent($domainEvent);
        }

        $applyMethod->setAccessible(true);
        $applyMethod->invoke($this, $domainEvent);
    }

    protected function getApplyMethod(DomainEvent $event): ?ReflectionMethod
    {
        $instanceReflection = new ReflectionObject($this);

        foreach ($instanceReflection->getMethods() as $method) {
            $attributes = $method->getAttributes(AppliesEvent::class);
            $attribute = end($attributes);

            if (empty($attributes)) {
                continue;
            }

            /** @var AppliesEvent $appliesAttribute */
            $appliesAttribute = $attribute->newInstance();

            if ($appliesAttribute->supports($event)) {
                return $method;
            }
        }

        return null;
    }

    public function withEventRecorder(EventRecorder $eventRecorder): self
    {
        $this->eventRecorder = $eventRecorder;

        return $this;
    }

    private function getEventStream(): MutableEventStream
    {
        if (null === $this->mutableEventStream) {
            $this->mutableEventStream = new MutableEventStream();
        }

        return $this->mutableEventStream;
    }

    private function getEventRecorder(): EventRecorder
    {
        if (null === $this->eventRecorder) {
            $this->eventRecorder = new EventRecorder(
                new SystemClock()
            );
        }

        return $this->eventRecorder;
    }
}
