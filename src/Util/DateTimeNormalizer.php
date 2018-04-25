<?php

declare(strict_types=1);

namespace App\Util;

/**
 * Description of DateTimeNormalizer
 *
 * @author Alsciende <alsciende@icloud.com>
 */
class DateTimeNormalizer
{
    public static function create(string $date): \DateTime
    {
        return \DateTime::createFromFormat(\DateTime::RFC3339, $date);
    }

    public static function date(\DateTime $dateTime): string
    {
        return $dateTime->format('Y-m-d');
    }

    public static function time(\DateTime $dateTime): string
    {
        return $dateTime->format('H:i:s');
    }

    public static function tz(\DateTime $dateTime): string
    {
        return $dateTime->getTimezone()->getName();
    }
}
