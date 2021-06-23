<?php
declare(strict_types=1);

namespace Landingi\Basket\Domain;

use Landingi\SharedKernel\BuildingBlocks\AggregateId;
use Symfony\Component\Uid\Uuid;

final class BasketId implements AggregateId
{
    private string $identifier;

    public function __construct(string $identifier)
    {
        $this->identifier = $identifier;
    }

    public static function nextIdentifier(): AggregateId
    {
        return new self(Uuid::v4()->toRfc4122());
    }

    public function __toString(): string
    {
        return $this->identifier;
    }
}
