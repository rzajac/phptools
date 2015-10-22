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
namespace Kicaj\Test\Cli;

use Kicaj\Tools\Cli\Colors;

/**
 * Class ColorsTest.
 *
 * @coversDefaultClass Kicaj\Tools\Cli\Colors
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class ColorsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getColoredStringProvider
     *
     * @covers ::getColoredString
     *
     * @param string $string
     * @param string $fgColorName
     * @param string $bgColorName
     * @param string $expected
     */
    public function test_httpHeaderFor($string, $fgColorName, $bgColorName, $expected)
    {
        $got = Colors::getColoredString($string, $fgColorName, $bgColorName);
        $this->assertSame($expected, $got);
    }

    public function getColoredStringProvider()
    {
        return [
            ['test', '', '', 'test'],
            ['test', 'not_exist', '', 'test'],
            ['test', 'not_exist', 'not_exist', 'test'],
            ['test', '', 'not_exist', 'test'],
            ['test', 'red', 'blue', "\033[0;31m\033[44mtest\033[0m"],
        ];
    }

    /**
     * @covers ::getForegroundColorNames
     */
    public function test_getForegroundColorNames()
    {
        $expColors = [
            'black',
            'dark_gray',
            'blue',
            'light_blue',
            'green',
            'light_green',
            'cyan',
            'light_cyan',
            'red',
            'light_red',
            'purple',
            'light_purple',
            'brown',
            'yellow',
            'light_gray',
            'white',
        ];

        $this->assertSame($expColors, Colors::getForegroundColorNames());
    }

    /**
     * @covers ::getBackgroundColorNames
     */
    public function test_getBackgroundColorNames()
    {
        $expColors = [
            'black',
            'red',
            'green',
            'yellow',
            'blue',
            'magenta',
            'cyan',
            'light_gray',
        ];

        $this->assertSame($expColors, Colors::getBackgroundColorNames());
    }

}
