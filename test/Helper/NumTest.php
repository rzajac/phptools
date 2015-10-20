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

use Kicaj\Tools\Helper\Num;

/**
 * Class NumTest.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\Num
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class NumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider equalWithinProvider
     *
     * @covers ::equalWithin
     *
     * @param int|float $a
     * @param int|float $b
     * @param int|float $delta
     * @param bool      $expected
     */
    public function test_equalWithin($a, $b, $delta, $expected)
    {
        $got = Num::equalWithin($a, $b, $delta);
        $this->assertSame($expected, $got);
    }

    public function equalWithinProvider()
    {
        return [
            [1, 1, 0, true],
            [1, 1, 1, true],
            [1, 1, 2, true],

            [1.0, 1, 0, true],
            [1.0, 1, 1, true],
            [1.0, 1, 2, true],

            [1.0, 1, 0.0, true],
            [1.0, 1, 1.0, true],
            [1.0, 1, 2.0, true],

            [1.0, 1.0, 0.0, true],
            [1.0, 1.0, 1.0, true],
            [1.0, 1.0, 2.0, true],

            [1, 2, 1, true],
            [1, 2, 2, true],

            [1.0, 2, 1, true],

            [1.1, 1.3, 0.2, true],
            [1.1, 1.3, 0.1, false],

            [1.0, 3, 1, false],
            [1.0, 3, NAN, false],

            [INF, 3, 1, false],
            [1.0, INF, 1, false],
            [INF, INF, 1, false],

            [NAN, 3, 1, false],
            [1.0, NAN, 1, false],
            [NAN, NAN, 1, false],
        ];
    }

    /**
     * @dataProvider oddEvenProvider
     *
     * @covers ::isOdd
     * @covers ::isEven
     *
     * @param int  $num
     * @param bool $isEven
     * @param bool $isOdd
     */
    public function test_oddEven($num, $isEven, $isOdd)
    {
        $even = Num::isEven($num);
        $odd = Num::isOdd($num);

        $this->assertSame($isEven, $even);
        $this->assertSame($isOdd, $odd);
    }

    public function oddEvenProvider()
    {
        return [
            [1, false, true],
            [2, true, false],
            [3, false, true],
            [4, true, false],
            [5, false, true],
            [6, true, false],
            [7, false, true],

            [1.1, false, false],
            [3.1, false, false],
        ];
    }
}
