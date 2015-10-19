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
 * Helper functions.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
abstract class Fn
{
    /**
     * No op.
     */
    public static function noop()
    {
    }

    /**
     * Returns newValue when oldValue !== ifNot.
     *
     * @param mixed $oldValue
     * @param mixed $ifNot
     * @param mixed $newValue
     *
     * @return mixed
     */
    public static function returnIfNot($oldValue, $ifNot, $newValue)
    {
        if ($oldValue === $ifNot) {
            return $oldValue;
        }

        return $newValue;
    }
}
