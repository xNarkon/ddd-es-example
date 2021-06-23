<?php
declare(strict_types=1);

namespace Landingi\SharedKernel\BuildingBlocks;

interface Identity
{
    public static function nextIdentifier(): Identity;
    public function __toString(): string;
}
