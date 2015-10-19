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

namespace Kicaj\Test\Tools\Date;

use Kicaj\Tools\Date\DateCalc;
use PHPUnit_Framework_TestCase;

/**
 * Class DateCalc_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Date\DateCalc
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class DateCalcTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::durationHI
     *
     * @dataProvider durationProvider
     *
     * @param int    $duration
     * @param string $formatted
     */
    public function testDurationFormatted($duration, $formatted)
    {
        $this->assertEquals(DateCalc::durationHI($duration), $formatted);
    }

    public function durationProvider()
    {
        return [
            [60, '1h 00min'],
            [62, '1h 02min'],
            [85, '1h 25min'],
            [30, '30min'],
            [0, '0min'],
            [10, '10min'],
            [9, '09min'],
            [125, '2h 05min'],
        ];
    }

    /**
     * @covers ::secondsSinceMidnight
     */
    public function testCalcSecondsSinceMidnight()
    {
        $secSince = DateCalc::secondsSinceMidnight(1, 1, 1);
        $this->assertSame(3661, $secSince);

        $secSince = DateCalc::secondsSinceMidnight(0, 1, 0);
        $this->assertSame(60, $secSince);
    }

    /**
     * @dataProvider secondsSinceMidnightStrProvider
     *
     * @covers ::secondsSinceMidnightStr
     *
     * @param string $timeStr
     * @param int    $expected
     */
    public function testSecondsSinceMidnightStr($timeStr, $expected)
    {
        $this->assertSame($expected, DateCalc::secondsSinceMidnightStr($timeStr));
    }

    public function secondsSinceMidnightStrProvider()
    {
        return array(
            ['01:01:01', 3661],
            ['01:01:01', 3661],
            ['00:01:00', 60],
            ['00:01', 60],
            ['00:01:00:00', null],
            ['03', null],
            ['', null],
        );
    }

    /**
     * @dataProvider formatTimeStrProvider
     *
     * @param int    $timeInt
     * @param bool   $withSeconds
     * @param string $expected
     */
    public function testFormatTimeStr($timeInt, $withSeconds, $expected)
    {
        $time = DateCalc::formatStrTime($timeInt, $withSeconds);
        $this->assertSame($expected, $time);
    }

    public function formatTimeStrProvider()
    {
        return array(
            array(192015, false, '19:20'),
            array(192015, true, '19:20:15'),
            array(0, false, '00:00'),
            array(0, true, '00:00:00'),
            array(15, false, '00:00'),
            array(15, true, '00:00:15'),
            array(1615, false, '00:16'),
            array(1615, true, '00:16:15'),
        );
    }
}
