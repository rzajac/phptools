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

use Exception;

/**
 * Helper class operating on objects.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
abstract class Obj
{
    /**
     * Get object property value or default if it does not exist.
     *
     * NOTES:
     *
     *  - this method does not handle PHP errors. Unless you use user defined
     *    error handler like in @see Err::errToException()
     *
     *  - objects implementing __get() magic method must also implement __isset()
     *
     * @param object $obj             The object
     * @param string $propName        The property name
     * @param mixed  $default         The default value to return if property name doesn't exist
     * @param bool   $handleException If set to true method will catch eny exceptions thrown when accessing properties
     *
     * @throws Exception
     *
     * @return mixed
     */
    public static function get($obj, $propName, $default = null, $handleException = true)
    {
        if (!is_object($obj)) {
            return $default;
        }

        if (property_exists($obj, $propName) || isset($obj->$propName)) {
            try {
                return $obj->$propName;
            } catch (Exception $e) {
                if ($handleException) {
                    return $default;
                }

                throw $e;
            }
        }

        return $default;
    }
}
