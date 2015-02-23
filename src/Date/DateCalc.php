<?php
/**
 * Copyright 2015 Rafal Zajac <rzajac@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

namespace Kicaj\Tools\Date;

/**
 * Class for handling date and time related calculations
 *
 * @package Kicaj\Tools\Date
 * @author Rafal Zajac <rzajac@gmail.com>
 */
abstract class DateCalc
{
    /**
     * Get duration in minutes formatted as ex.: 2h 10min
     *
     * @param  int $duration The duration in minutes
     *
     * @return string
     */
    public static function durationHI($duration)
    {
        $duration = $duration * 60; // Convert to seconds
        $hours    = gmdate('G', $duration);
        $minutes  = gmdate('i', $duration);

        if ($minutes == '00' && $hours == '00')
        {
            $minutes = '0';
        }

        $formatted = $minutes . 'min';

        if ($hours != 0)
        {
            $formatted = $hours . 'h ' . $formatted;
        }

        return $formatted;
    }

    /**
     * Return number of seconds since midnight
     *
     * @param int $hour   The hour 0 - 23
     * @param int $minute The minute 0 - 59
     * @param int $second The second 0 - 59
     *
     * @return int
     */
    public static function secondsSinceMidnight($hour, $minute, $second)
    {
        return $hour * 3600 + $minute * 60 + $second;
    }

    /**
     * Return number of seconds since midnight
     *
     * @param string $time The time in format: HH:MM:SS or HH:MM
     *
     * @return int|null Returns null on error
     */
    public static function secondsSinceMidnightStr($time)
    {
        $time_a = explode(':', $time);

        switch(count($time_a))
        {
            case 0:
            case 1:
                return null;

            case 2:
                // Add seconds
                $time_a[] = 0;
                break;

            case 3:
                break;

            default:
                return null;
        }

        return self::secondsSinceMidnight((int)$time_a[0], (int)$time_a[1], (int)$time_a[2]);
    }
}
