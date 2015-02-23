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

namespace Kicaj\Tools\Helper;

/**
 * Debugging helpers
 *
 * @package Kicaj\Tools\Helper
 * @author Rafal Zajac <rzajac@gmail.com>
 */
abstract class Debug
{
    /**
     * Prints stack trace
     *
     * @param bool $asArray
     *
     * @return string
     */
    public static function getCallStack($asArray = false)
    {
        $i = 0;
        $resp = [];

        if (! $asArray) $resp[] = str_repeat("=", 50);

        foreach (debug_backtrace() as $node)
        {
            $file = Arr::get($node, 'file', '');
            $file = $file ?: 'no_file';

            $fn = $node['function'];
            $line = Arr::get($node, 'line', -1);

            $i = $asArray ? '' : "$i.";

            $resp[] = $i . $file . ":" . $fn . " " . $line;
            $i++;
        }

        return $asArray ? $resp : join("\n", $resp);
    }
}
