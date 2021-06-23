<?php
declare(strict_types=1);

namespace Landingi\SharedKernel;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;

final class SystemClock implements Clock
{
    private ?DateTimeZone $timeZone = null;

    public function __construct(?string $timeZone = null)
    {
        if (null !== $timeZone) {
            $this->timeZone = new DateTimeZone($timeZone);
        }
    }

    public function now(): DateTimeInterface
    {
        if (null === $this->timeZone) {
            return new DateTimeImmutable();
        }

        return (new DateTimeImmutable())->setTimezone($this->timeZone);
    }
}
