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

namespace Kicaj\Tools\Cli;

/**
 * CLI colors helper class.
 */
class Colors
{
    /**
     * Array of foreground color names and values.
     *
     * @var array
     */
    private static $foreground_colors = [
        'black' => '0;30',
        'dark_gray' => '1;30',
        'blue' => '0;34',
        'light_blue' => '1;34',
        'green' => '0;32',
        'light_green' => '1;32',
        'cyan' => '0;36',
        'light_cyan' => '1;36',
        'red' => '0;31',
        'light_red' => '1;31',
        'purple' => '0;35',
        'light_purple' => '1;35',
        'brown' => '0;33',
        'yellow' => '1;33',
        'light_gray' => '0;37',
        'white' => '1;37',
    ];

    /**
     * Array of background color names and values.
     *
     * @var array
     */
    private static $background_colors = [
        'black' => '40',
        'red' => '41',
        'green' => '42',
        'yellow' => '43',
        'blue' => '44',
        'magenta' => '45',
        'cyan' => '46',
        'light_gray' => '47',
    ];

    /**
     * Returns colored string.
     *
     * @param string $string
     * @param string $foreground_color
     * @param string $background_color
     *
     * @return string
     */
    public static function getColoredString($string, $foreground_color = '', $background_color = '')
    {
        $colored_string = '';

        // Check if given foreground color exists
        if (isset(static::$foreground_colors[$foreground_color])) {
            $colored_string .= "\033[".static::$foreground_colors[$foreground_color].'m';
        }

        // Check if given background color exists
        if (isset(static::$background_colors[$background_color])) {
            $colored_string .= "\033[".static::$background_colors[$background_color].'m';
        }

        if ($colored_string) {
            // Add string and end coloring
            $colored_string .= $string."\033[0m";
        } else {
            $colored_string = $string;
        }

        return $colored_string;
    }

    /**
     * Returns all foreground color names.
     *
     * @return string[]
     */
    public static function getForegroundColorNames()
    {
        return array_keys(static::$foreground_colors);
    }

    /**
     * Returns all background color names.
     *
     * @return string[]
     */
    public static function getBackgroundColorNames()
    {
        return array_keys(static::$background_colors);
    }
}
