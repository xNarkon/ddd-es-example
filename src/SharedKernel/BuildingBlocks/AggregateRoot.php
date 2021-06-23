<?php
declare(strict_types=1);

namespace Landingi\SharedKernel\BuildingBlocks;

interface AggregateRoot
{
    public function getAggregateId(): AggregateId;
}
