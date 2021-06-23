<?php
declare(strict_types=1);

namespace Landingi\Basket\Domain\Event;

use Landingi\Basket\Domain\BasketId;
use Landingi\SharedKernel\BuildingBlocks\DomainEvent;

final class BasketCreated implements DomainEvent
{
    private BasketId $id;

    public function __construct(BasketId $id)
    {
        $this->id = $id;
    }

    public function getId(): BasketId
    {
        return $this->id;
    }
}
