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
 * Helper class operating on $_POST superglobal array.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
abstract class POST
{
    /**
     * Get key from $_POST superglobal array.
     *
     * @param string $key     The key to get value for
     * @param mixed  $default The default value to return if key doesn't exist
     *
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return Arr::get($_POST, $key, $default);
    }
}
