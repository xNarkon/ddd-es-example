<?php
declare(strict_types=1);

namespace Landingi\SharedKernel\EventSourcing\Exception;

use Exception;
use Landingi\SharedKernel\BuildingBlocks\DomainEvent;

final class MissingEventApplyMethod extends Exception
{
    public static function createForEvent(DomainEvent $event): self
    {
        return new self(
            sprintf('There is missing apply method for event: %s', get_class($event))
        );
    }
}
