<?php

namespace App\Distribution;

class DeterministicDistribution implements DistributionInterface
{
    const STEEPNESS = 0.3;

    public function boundedAndCentered(int $min, int $max, int $center, int $size)
    {
        $result = [];

        $deviation = 0;

        while($size > 0 && $deviation < 10) {
            $current = $center + $deviation;
            if($current >= $min && $current <= $max) {
                $chunk = ceil($size  * self::STEEPNESS);
                for($i = 0; $i < $chunk; $i++) {
                    $result[] = $current;
                }

                $size -= $chunk;
            }

            if ($deviation < 0) {
                $deviation = -1 * $deviation + 1;
            } else if ($deviation > 0) {
                $deviation = -1 * $deviation;
            } else {
                $deviation = 1;
            }
        }

        for($i = 0; $i < $size; $i++) {
            $result[] = $center;
        }

        return $result;
    }
}
