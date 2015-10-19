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

/**
 * Helper class with number related methods.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Num
{
    /**
     * Are two numbers equal within given delta.
     *
     * @param int|float $a
     * @param int|float $b
     * @param int|float $delta
     *
     * @return bool
     */
    public static function equalWithin($a, $b, $delta)
    {
        if (is_infinite($a) xor is_infinite($b)) {
            return false;
        }

        if (is_nan($a) || is_nan($b) || is_nan($delta)) {
            return false;
        }

        return abs($a - $b) <= $delta;
    }

    /**
     * Return true if num is odd.
     *
     * @param int $num
     *
     * @return bool
     */
    public static function isOdd($num)
    {
        if (is_float($num)) {
            return false;
        }

        return $num % 2 !== 0;
    }

    /**
     * Return true if num is even.
     *
     * @param int $num
     *
     * @return bool
     */
    public static function isEven($num)
    {
        if (is_float($num)) {
            return false;
        }

        return $num % 2 === 0;
    }
}
