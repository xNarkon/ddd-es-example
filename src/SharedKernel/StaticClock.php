<?php
declare(strict_types=1);

namespace Landingi\SharedKernel;

use DateTimeInterface;

final class StaticClock implements Clock
{
    private DateTimeInterface $dateTime;

    public function __construct(DateTimeInterface $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function now(): DateTimeInterface
    {
        return $this->dateTime;
    }
}
