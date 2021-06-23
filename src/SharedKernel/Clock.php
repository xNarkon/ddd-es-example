<?php
declare(strict_types=1);

namespace Landingi\SharedKernel;

use DateTimeInterface;

interface Clock
{
    public function now(): DateTimeInterface;
}
