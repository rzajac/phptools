<?php

/**
 * Copyright 2015 Rafal Zajac <rzajac@gmail.com>.
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

namespace Kicaj\Tools\Helper;

use stdClass;

/**
 * Helper class operating on arrays.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
abstract class Arr
{
    /**
     * Returns TRUE if all values in the passed array are equal to $value.
     *
     * @param array $arr    The array
     * @param mixed $value  The value to check for
     * @param bool  $strict If TRUE the strict mode is used
     *
     * @return bool
     */
    public static function every(array &$arr, $value, $strict = true)
    {
        $filter = function ($v) use ($value, $strict) {
            return $strict ? $v === $value : $v == $value;
        };

        return count(array_filter($arr, $filter)) === count($arr);
    }

    /**
     * Translates associative array to stdClass.
     *
     * @param array $arr
     *
     * @return stdClass
     */
    public static function toObject(array $arr)
    {
        return (object) $arr;
    }

    /**
     * Fill array to $minCount elements with given value.
     *
     * @param array $arr      The array to fill up
     * @param int   $minCount The minimum number of elements
     * @param mixed $value    The value to fill array with
     *
     * @return array
     */
    public static function fillUp(&$arr, $minCount, $value)
    {
        $arrCount = count($arr);

        if ($arrCount >= $minCount) {
            return $arr;
        }

        for ($i = 0; $i < $minCount - $arrCount; ++$i) {
            $arr[] = $value;
        }

        return $arr;
    }

    /**
     * Fill an array with a range of numbers.
     *
     * @param int $max   The maximum ending number
     * @param int $start The start number
     * @param int $step  The stepping
     *
     * @return array
     */
    public static function range($max, $start = 1, $step = 1)
    {
        if ($step < 1) {
            return [];
        }

        $array = [];
        for ($i = $start; $i <= $max; $i += $step) {
            $array[] = $i;
        }

        return $array;
    }

    /**
     * Return array key value or default if it does not exist.
     *
     * @param array  $array   The array
     * @param string $key     The key to get value for
     * @param mixed  $default The default value to return if key doesn't exist
     *
     * @return mixed
     */
    public static function get($array, $key, $default = null)
    {
        if (!is_array($array)) {
            return $default;
        }

        return array_key_exists($key, $array) ? $array[$key] : $default;
    }

    /**
     * Get array.
     *
     * @param array        $array
     * @param string|array $path
     * @param mixed        $default
     *
     * @return mixed
     */
    public static function fetch($array, $path, $default = null)
    {
        // $array must be an array
        if (!is_array($array)) {
            return $default;
        }

        $path = is_array($path) ? $path : explode('.', $path);
        $levels = count($path);

        // No path means the received array
        if ($levels === 0) {
            return $array;
        }

        $ret = $default;
        $key = array_shift($path);
        $levels -= 1;

        if (array_key_exists($key, $array)) {
            if (is_array($array[$key]) && $levels > 0) {
                $ret = self::fetch($array[$key], $path, $default);
            } else {
                $ret = $array[$key];
            }
        }

        return $ret;
    }

    /**
     * Remove keys listed in $keysToRemove array.
     *
     * @param array        $array        The array to remove keys from
     * @param array|string $keysToRemove The key or keys to remove
     *
     * @return array
     */
    public static function remove(&$array, $keysToRemove)
    {
        if (!is_array($keysToRemove)) {
            $keysToRemove = [$keysToRemove];
        }

        return array_diff_key($array, array_flip($keysToRemove));
    }

    /**
     * Keep only the keys listed in $keysToKeep array.
     *
     * @param array        $array      The array to remove keys from
     * @param array|string $keysToKeep The keys to keep
     *
     * @return array
     */
    public static function keep(&$array, $keysToKeep)
    {
        if (!is_array($keysToKeep)) {
            $keysToKeep = [$keysToKeep];
        }

        return array_intersect_key($array, array_flip($keysToKeep));
    }
}
