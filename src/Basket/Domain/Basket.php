<?php
declare(strict_types=1);

namespace Landingi\Basket\Domain;

use Landingi\Basket\Domain\Event\BasketCreated;
use Landingi\SharedKernel\EventSourcing\Attributes\AppliesEvent;
use Landingi\SharedKernel\EventSourcing\EventSourcedAggregateRoot;

final class Basket extends EventSourcedAggregateRoot
{
    private BasketId $identifier;

    public function __construct(BasketId $identifier)
    {
        $this->recordThat(new BasketCreated($identifier));
    }

    #[AppliesEvent(BasketCreated::class)]
    private function applyBasketCreated(BasketCreated $event): void
    {
        $this->identifier = $event->getId();
    }

    public function getAggregateId(): BasketId
    {
        return $this->identifier;
    }
}
