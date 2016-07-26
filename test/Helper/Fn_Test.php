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

use Kicaj\Tools\Helper\Fn;

/**
 * Class Fn_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\Fn
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Fn_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::noop
     */
    public function test_noop()
    {
        /* @noinspection PhpVoidFunctionResultUsedInspection */
        $this->assertSame(null, Fn::noop());
    }

    /**
     * @dataProvider returnIfNotProvider
     *
     * @covers ::returnIfNot
     *
     * @param mixed $oldValue
     * @param mixed $ifNot
     * @param mixed $newValue
     * @param mixed $expected
     */
    public function test_returnIfNot($oldValue, $ifNot, $newValue, $expected)
    {
        // When
        $got = Fn::returnIfNot($oldValue, $ifNot, $newValue);

        // Then
        $this->assertSame($expected, $got);
    }

    public function returnIfNotProvider()
    {
        return array(
            [false, true, true, true],
            [true, true, true, true],
            [true, true, false, true],

            [false, false, true, false],
            [true, false, false, false],
            [true, false, true, true],
        );
    }
}
