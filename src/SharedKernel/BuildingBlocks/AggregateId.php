<?php
declare(strict_types=1);

namespace Landingi\SharedKernel\BuildingBlocks;

interface AggregateId extends Identity
{
    public static function nextIdentifier(): AggregateId;
}
