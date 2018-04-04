<?php

namespace App\Distribution;

interface DistributionInterface
{
    public function boundedAndCentered(int $min, int $max, int $center, int $size);
}
