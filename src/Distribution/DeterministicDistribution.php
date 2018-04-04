<?php

namespace App\Distribution;

class DeterministicDistribution implements DistributionInterface
{
    const RATIO = [
        0.8,
        0.1,
        0.1,
    ];

    public function boundedAndCentered(int $min, int $max, int $center, int $size)
    {
        $result = [];

        $difficulties = [
            $center,
            $center - 1 >= $min ? $center - 1 : $center + 1,
            $center + 1 <= $max ? $center + 1 : $center - 1,
        ];

        for ($part = 0; $part < count(self::RATIO); $part++) {
            for ($i = 0; $i < round($size * self::RATIO[$part]); $i++) {
                $result[] = $difficulties[$part];
            }
        }

        return $result;
    }
}
