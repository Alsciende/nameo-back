<?php

declare(strict_types=1);

namespace App\Distribution;

interface DistributionInterface
{
    public function boundedAndCentered(int $min, int $max, int $center, int $size);
}
