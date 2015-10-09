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

use Kicaj\Tools\Helper\Arr;
use stdClass;

/**
 * Class ArrTest.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\Arr
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class ArrTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider everyProvider
     *
     * @covers ::every
     *
     * @param bool  $exp
     * @param mixed $value
     * @param bool  $strict
     * @param array $arr
     */
    public function test_every($exp, $value, $strict, $arr)
    {
        $this->assertSame($exp, Arr::every($arr, $value, $strict));
    }

    public function everyProvider()
    {
        return [
            [true, 1, true, [1, 1, 1, 1]],
            [true, 1, false, [1, 1, 1, '1']],

            [false, 1, true, [1, 1, 1, '1']],
            [false, 1, true, [1, 1, 1, 2]],
        ];
    }

    /**
     * @covers ::toObject
     */
    public function test_toObject()
    {
        $arr = ['a' => 1, 'b' => 2];
        $got = Arr::toObject($arr);

        $exp = new stdClass();
        $exp->a = 1;
        $exp->b = 2;

        $this->assertEquals($exp, $got);
    }

    /**
     * @dataProvider fillUpProvider
     *
     * @covers ::fillUp
     *
     * @param mixed $value
     * @param int   $minCount
     * @param array $arr
     * @param array $exp
     */
    public function test_fillUp($value, $minCount, $arr, $exp)
    {
        $got = Arr::fillUp($arr, $minCount, $value);
        $this->assertSame($exp, $got);
    }

    public function fillUpProvider()
    {
        return [
            ['a', 3, [], ['a', 'a', 'a']],
            ['a', 4, [], ['a', 'a', 'a', 'a']],
            ['a', 4, ['a', 'a'], ['a', 'a', 'a', 'a']],
        ];
    }

    /**
     * @dataProvider rangeProvider
     *
     * @covers ::range
     *
     * @param int   $start
     * @param int   $max
     * @param int   $step
     * @param array $expected
     */
    public function test_range($start, $max, $step, $expected)
    {
        $got = Arr::range($max, $start, $step);
        $this->assertSame($expected, $got);
    }

    public function rangeProvider()
    {
        return [
            [1, 3, 1, [1, 2, 3]],
            [2, 3, 1, [2, 3]],
            [4, 10, 2, [4, 6, 8, 10]],
        ];
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
        $got = Arr::get($array, $key, $default);
        $this->assertSame($expected, $got);
    }

    public function getProvider()
    {
        return [
            ['a', null, 1, ['a' => 1, 'b' => 2]],
            ['c', null, null, ['a' => 1, 'b' => 2]],
            ['c', 3, 3, ['a' => 1, 'b' => 2]],
            ['b', 123, 2, ['a' => 1, 'b' => 2]],
        ];
    }

    /**
     * @dataProvider removeProvider
     *
     * @covers ::remove
     *
     * @param string|array $toRemove
     * @param array        $arr
     * @param array        $expected
     */
    public function test_remove($toRemove, $arr, $expected)
    {
        $got = Arr::remove($arr, $toRemove);
        $this->assertSame($expected, $got);
    }

    public function removeProvider()
    {
        return [
            // Nothing to remove
            ['', ['a' => 1, 'b' => 2, 'c' => 3], ['a' => 1, 'b' => 2, 'c' => 3]],
            [[], ['a' => 1, 'b' => 2, 'c' => 3], ['a' => 1, 'b' => 2, 'c' => 3]],

            // Tests for remove
            ['a', ['a' => 1, 'b' => 2, 'c' => 3], ['b' => 2, 'c' => 3]],
            [['a'], ['a' => 1, 'b' => 2, 'c' => 3], ['b' => 2, 'c' => 3]],
            [['a', 'c'], ['a' => 1, 'b' => 2, 'c' => 3], ['b' => 2]],
        ];
    }

    /**
     * @dataProvider keepProvider
     *
     * @covers ::keep
     *
     * @param string|array $toKeep
     * @param array        $arr
     * @param array        $expected
     */
    public function test_keep($toKeep, $arr, $expected)
    {
        $got = Arr::keep($arr, $toKeep);
        $this->assertSame($expected, $got);
    }

    public function keepProvider()
    {
        return [
            // Nothing to kep
            ['', ['a' => 1, 'b' => 2, 'c' => 3], []],
            [[], ['a' => 1, 'b' => 2, 'c' => 3], []],

            // Tests for keeping
            ['a', ['a' => 1, 'b' => 2, 'c' => 3], ['a' => 1]],
            [['a'], ['a' => 1, 'b' => 2, 'c' => 3], ['a' => 1]],
            [['a', 'c'], ['a' => 1, 'b' => 2, 'c' => 3], ['a' => 1, 'c' => 3]],
        ];
    }

    public function test_fetch()
    {
        $this->assertSame('value', Arr::fetch($this->array, 'level0_0.level1_0.key'));
        $this->assertSame('def', Arr::fetch($this->array, 'level0_0.level1_0.key1', 'def'));
        $this->assertSame(null, Arr::fetch($this->array, 'level0_0.level1_0.key1'));
        $this->assertSame(['level1_0' => ['key' => 'value']], Arr::fetch($this->array, 'level0_0'));
        $this->assertSame(['key' => 'value'], Arr::fetch($this->array, 'level0_0.level1_0'));
        $this->assertSame(null, Arr::fetch($this->array, 'a.b.c'));
        $this->assertSame('defValue', Arr::fetch($this->array, 'a', 'defValue'));
    }

    protected $array = [
      'level0_0' => [
          'level1_0' => [
              'key' => 'value',
          ],
      ],
    ];
}
