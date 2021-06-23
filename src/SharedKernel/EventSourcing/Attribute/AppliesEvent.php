<?php
declare(strict_types=1);

namespace Landingi\SharedKernel\EventSourcing\Attributes;

use Attribute;
use Landingi\SharedKernel\BuildingBlocks\DomainEvent;
use JetBrains\PhpStorm\Pure;

#[Attribute(Attribute::TARGET_METHOD)]
class AppliesEvent
{
    private string $domainEventClass;

    /**
     * @param string $domainEventClass
     */
    public function __construct(string $domainEventClass)
    {
        $this->domainEventClass = $domainEventClass;
    }

    #[Pure] public function supports(DomainEvent $domainEvent): bool
    {
        return get_class($domainEvent) === $this->domainEventClass;
    }
}
