<?php

declare(strict_types=1);

namespace App\Util;

class ArrayPicker
{
    public static function pickOne(&$list)
    {
        $count = count($list);
        if ($count > 0) {
            $removed = array_splice($list, mt_rand(0, $count - 1), 1);

            return $removed[0];
        }

        throw new \OutOfRangeException('Cannot pick an element from an empty array. Check the array size beforehand.');
    }
}
