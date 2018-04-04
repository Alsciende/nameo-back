<?php

namespace App\Distribution;

class RandomDistribution implements DistributionInterface
{
    public function boundedAndCentered(int $min, int $max, int $center, int $size)
    {
        $result = [];

        for ($i = 0; $i < $size; $i++) {
            $result[] = $this->rand($min, $max, $center);
        }

        return $result;
    }

    private function rand(int $min, int $max, int $target): int
    {
        // random number between -PI/2 and PI/2
        $rand = M_PI * (mt_rand() / mt_getrandmax() - 1 / 2);

        // passed through tangent => random between -Infinity and +Infinity, with a strong presence around 0
        $trand = tan($rand);

        // normalized around $target and turned into integer
        $result = intval(round($trand + $target, 0));

        // constrained to the boundaries
        if ($result < $min || $result > $max) {
            $result = $target;
        }

        return $result;
    }
}
