<?php

namespace App\Helpers;

/**
 * CalcHelper Class
 */
class CalcHelper
{

    /**
     * Convert value from meters to yards
     * 
     * @param int $value - value in meters
     * @return int
     */
    public static function meters_to_yards($value)
    {
        return $value * 1.09361;
    }

    /**
     * Convert value from yards to meters
     * 
     * @param int $value - value in yards
     * @return int
     */
    public static function yards_to_meters($value)
    {
        return $value / 1.09361;
    }
}
