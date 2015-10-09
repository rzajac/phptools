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

use Kicaj\Tools\Helper\Str;

/**
 * Class StrTest.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\Str
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class StrTest extends \PHPUnit_Framework_TestCase
{
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
        $got = Str::returnIfNot($oldValue, $ifNot, $newValue);
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

    /**
     * @dataProvider randomStringProvider
     *
     * @covers ::randomString
     *
     * @param int $length
     */
    public function test_randomString($length)
    {
        $str = Str::randomString($length);
        $this->assertSame($length, strlen($str));
        $this->assertSame(true, ctype_lower($str));
    }

    public function randomStringProvider()
    {
        return [
            [10],
            [15],
            [32],
            [100],
        ];
    }

    /**
     * @dataProvider generateTokenProvider
     *
     * @covers ::generateToken
     *
     * @param int $length
     */
    public function test_generateToken($length)
    {
        $str = Str::generateToken($length, true);
        $this->assertSame($length, strlen($str));

        $str = Str::generateToken($length, false);
        $this->assertSame($length, strlen($str));
    }

    public function generateTokenProvider()
    {
        return [
            [32],
            [64],
            [128],
            [256],
        ];
    }

    /**
     * @dataProvider emptyOnFalseProvider
     *
     * @covers ::emptyOnFalse
     *
     * @param mixed $value
     * @param mixed $expected
     */
    public function test_emptyOnFalse($value, $expected)
    {
        $got = Str::emptyOnFalse($value);
        $this->assertSame($expected, $got);
    }

    public function emptyOnFalseProvider()
    {
        return [
            [false, ''],
            [0, ''],
            [0.0, ''],
            ['', ''],
            ['0', ''],
            [[], ''],
            [null, ''],

            ['aa', 'aa'],
            [123, 123],
        ];
    }

    /**
     * @dataProvider slugifyProvider
     *
     * @covers ::slugify
     *
     * @param string $str
     * @param string $expected
     */
    public function test_slugify($str, $expected)
    {
        $got = Str::slugify($str);
        $this->assertSame($expected, $got);
    }

    public function slugifyProvider()
    {
        return [
            ['aa aa', 'aa-aa'],
            ['Aa Aa', 'aa-aa'],
            ['Aą Aą', 'aa-aa'],
            ['#r^723z', 'r-723z'],
            ['!@#$%^&*()_-+', 'n-a'],
        ];
    }

    /**
     * @dataProvider startsWithProvider
     *
     * @covers ::startsWith
     *
     * @param string $str
     * @param string $needle
     * @param bool   $expected
     */
    public function test_startsWith($str, $needle, $expected)
    {
        $got = Str::startsWith($str, $needle);
        $this->assertSame($expected, $got);
    }

    public function startsWithProvider()
    {
        return [
            ['aaaBBB', 'aa', true],
            ['aaaBBB', 'aaa', true],
            ['aaaBBB', 'bb', false],
            ['aaaBBB', 'AA', false],
        ];
    }

    /**
     * @dataProvider endsWithProvider
     *
     * @covers ::endsWith
     *
     * @param string $str
     * @param string $needle
     * @param bool   $expected
     */
    public function test_endsWith($str, $needle, $expected)
    {
        $got = Str::endsWith($str, $needle);
        $this->assertSame($expected, $got);
    }

    public function endsWithProvider()
    {
        return [
            ['aaaBBB', 'BB', true],
            ['aaaBBB', 'BBB', true],
            ['aaaBBB', 'B', true],
            ['aaaBBB', '', true],
            ['aaaBBB', 'bb', false],
        ];
    }

    /**
     * @dataProvider camelCaseToUnderscoreProvider
     *
     * @covers ::camelCaseToUnderscore
     *
     * @param string $str
     * @param string $expected
     */
    public function test_camelCaseToUnderscore($str, $expected)
    {
        $got = Str::camelCaseToUnderscore($str);
        $this->assertSame($expected, $got);
    }

    public function camelCaseToUnderscoreProvider()
    {
        return [
            ['AaaBbb', 'aaa_bbb'],
            ['AaaBbbCcc', 'aaa_bbb_ccc'],
        ];
    }

    /**
     * @covers ::getRandomWeightedElement
     */
    public function test_getRandomWeightedElement()
    {
        $iterations = 1000;

        $cond = ['A' => 5.0, 'B' => 35.0, 'C' => 60.0];
        $count = ['A' => 0, 'B' => 0, 'C' => 0];

        for ($x = 0; $x < $iterations; ++$x) {
            $got = Str::getRandomWeightedElement($cond);
            ++$count[$got];
        }

        $aPercent = round($count['A'] / $iterations * 100, 0);
        $bPercent = round($count['B'] / $iterations * 100, 0);
        $cPercent = round($count['C'] / $iterations * 100, 0);

        // Accuracy within 3% is fine
        $this->assertEquals($cond['A'], $aPercent, '', 3.0);
        $this->assertEquals($cond['B'], $bPercent, '', 3.0);
        $this->assertEquals($cond['C'], $cPercent, '', 3.0);
    }
}
