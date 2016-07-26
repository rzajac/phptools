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
namespace Kicaj\Test\Tools\Helper;

use Kicaj\Tools\Helper\SERVER;
use stdClass;

/**
 * Class SERVER_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\SERVER
 *
 * @author             Rafal Zajac <rzajac@gmail.com>
 */
class SERVER_Test extends \PHPUnit_Framework_TestCase
{
    protected $server;

    protected function setUp()
    {
        $this->server = $_SERVER;
    }

    protected function tearDown()
    {
        $_SERVER = $this->server;
    }

    /**
     * @dataProvider getProvider
     *
     * @covers ::get
     *
     * @param string $key
     * @param mixed  $default
     * @param mixed  $expected
     * @param array  $array
     */
    public function test_get($key, $default, $expected, $array)
    {
        // Given
        $_SERVER = $array;

        // When
        $got = SERVER::get($key, $default);

        // Then
        $this->assertSame($expected, $got);
    }

    public function getProvider()
    {
        return [
            ['a', null, 1, ['a' => 1, 'b' => 2]],
            ['c', null, null, ['a' => 1, 'b' => 2]],
            ['c', 3, 3, ['a' => 1, 'b' => 2]],
            ['b', 123, 2, ['a' => 1, 'b' => 2]],

            ['b', 123, 123, new stdClass],
        ];
    }
}
