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

use Kicaj\Tools\Date\DateTime;
use Kicaj\Tools\Helper\Str;

/**
 * Class Str_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\Str
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Str_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider randomStringProvider
     *
     * @covers ::randomString
     *
     * @param int $length
     */
    public function test_randomString($length)
    {
        // When
        $str = Str::randomString($length);

        // Then
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
        // When
        $strStrong = Str::generateToken($length, true);
        $strWeak = Str::generateToken($length, false);

        // Then
        $this->assertSame($length, strlen($strStrong));
        $this->assertSame($length, strlen($strWeak));
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
        // When
        $got = Str::emptyOnFalse($value);

        // Then
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
        // When
        $got = Str::slugify($str);

        // Then
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
        // When
        $got = Str::startsWith($str, $needle);

        // Then
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
        // When
        $got = Str::endsWith($str, $needle);

        // Then
        $this->assertSame($expected, $got);
    }

    public function endsWithProvider()
    {
        return [
            ["aaaBBB", 'BB', true],
            ["aaaBBB", 'BBB', true],
            ["aaaBBB", 'B', true],
            ["aaaBBB", '', true],
            ["aaaBBB", 'bb', false],
            ["aaa\nBBB\naa;", ';', true],
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
        // When
        $got = Str::camelCaseToUnderscore($str);

        // Then
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
     * @dataProvider underscoreToCamelCaseProvider
     *
     * @covers ::underscoreToCamelCase
     *
     * @param string $str
     * @param string $expected
     */
    public function test_underscoreToCamelCase($str, $expected)
    {
        // When
        $got = Str::underscoreToCamelCase($str);

        // Then
        $this->assertSame($expected, $got);
    }

    public function underscoreToCamelCaseProvider()
    {
        return [
            ['aaa_bbb', 'AaaBbb'],
            ['aaa_bbb_ccc', 'AaaBbbCcc'],
        ];
    }

    /**
     * @covers ::getRandomWeightedElement
     */
    public function test_getRandomWeightedElement()
    {
        // Given
        $iterations = 1000;

        $cond = ['A' => 5.0, 'B' => 35.0, 'C' => 60.0];
        $count = ['A' => 0, 'B' => 0, 'C' => 0];

        // When
        for ($x = 0; $x < $iterations; ++$x) {
            $got = Str::getRandomWeightedElement($cond);
            ++$count[$got];
        }

        $aPercent = round($count['A'] / $iterations * 100, 0);
        $bPercent = round($count['B'] / $iterations * 100, 0);
        $cPercent = round($count['C'] / $iterations * 100, 0);

        // Then
        // Accuracy within 3% is fine
        $this->assertEquals($cond['A'], $aPercent, '', 3.0);
        $this->assertEquals($cond['B'], $bPercent, '', 3.0);
        $this->assertEquals($cond['C'], $cPercent, '', 3.0);
    }

    /**
     * @dataProvider oneLineProvider
     *
     * @param string $test
     * @param string $expected
     *
     * @covers ::oneLine
     */
    public function test_oneLine($test, $expected)
    {
        $this->assertSame($expected, Str::oneLine($test));
    }

    public function oneLineProvider()
    {
        return [
            ["aaa", "aaa"],
            ["a a a", "a a a"],
            ["a\n a\na", "a aa"],
            ["a  a   \na", "a a a"],
            ["a a a\n", "a a a"],
            ["a a a ", "a a a"],
            [" a a a ", "a a a"],
            [" a a a", "a a a"],
        ];
    }

    /**
     * @dataProvider toStringProvider
     *
     * @covers ::toString
     *
     * @param mixed  $value
     * @param string $expected
     */
    public function test_toString($value, $expected)
    {
        // When
        $got = Str::toString($value);

        // Then
        $this->assertSame($expected, $got);
    }

    public function toStringProvider()
    {
        $time = new DateTime('1970-01-01 10:12:13');

        $std = new \stdClass;

        return [
            [123, '123'],
            [123.34, '123.34'],
            [null, 'null'],
            [false, 'false'],
            [true, 'true'],
            [[1, 2, 3], '[1,2,3]'],
            [$time, '1970-01-01 10:12:13'],
            [$std, '[no string representation]'],
        ];
    }

    /**
     * @dataProvider containsProvider
     *
     * @covers ::contains
     *
     * @param string $haystack
     * @param string $needle
     * @param bool $ignoreCase
     * @param bool $expected
     */
    public function test_containsProvider($haystack, $needle, $ignoreCase, $expected)
    {
        // When
        $got = Str::contains($haystack, $needle, $ignoreCase);

        // Then
        $this->assertSame($expected, $got);
    }

    public function containsProvider()
    {
        return [
            ['Some sentence as haystack.', 'sentence', false, true],
            ['Some sentence as haystack.', 'sentence', true, true],
            ['Some sentence as haystack.', 'Sentence', false, false],
            ['Some sentence as haystack.', 'Sentence', true, true],

            ['Some sentence as haystack.', 'Som', False, true],
            ['Some sentence as haystack.', 'Som', true, true],
        ];
    }

}
