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
namespace Kicaj\Test\PhpTools\Tools\Date;

use Kicaj\Tools\Date\DateTime;
use Kicaj\Tools\Date\DateTimeDMY;
use Kicaj\Tools\Date\DateTimeDMYHIS;
use Kicaj\Tools\Date\DateTimeYMD;
use Kicaj\Tools\Date\DateTimeYMDHI;
use PHPUnit_Framework_TestCase;

/**
 * Class DateTime_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Date\DateTime
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class DateTimeTest extends PHPUnit_Framework_TestCase
{
    /**
     * Default time zone name.
     *
     * @var string
     */
    protected $defaultTz;

    /**
     * Time zone that has been set.
     *
     * @var string
     */
    protected $setTz;

    protected function setUp()
    {
        // Current time zone
        $this->defaultTz = date_default_timezone_get();

        // Pick and set time zone that is not UTC
        $this->setTz = reset(array_diff(['Europe/Warsaw', 'Brazil/Acre'], [$this->defaultTz]));
        date_default_timezone_set($this->setTz);
    }

    protected function tearDown()
    {
        // Set time zone to the default one set in PHP
        date_default_timezone_set($this->defaultTz);
    }

    /**
     * @covers ::__construct
     * @covers ::make
     */
    public function testMakeConstruct()
    {
        $dt = new DateTime('2013-11-12');
        $this->assertEquals('2013-11-12 00:00:00', $dt->format());

        $dt = DateTime::make('2013-11-12');
        $this->assertEquals('2013-11-12 00:00:00', $dt->format());

        $dt = new DateTime('2013-11-12');
        $this->assertEquals('2013-11-12 00:00:00', $dt->format());
        $this->assertNotEquals('UTC', $dt->getTimezone()->getName());

        $dt = DateTime::make('2013-11-12');
        $this->assertEquals('2013-11-12 00:00:00', $dt->format());
        $this->assertNotEquals('UTC', $dt->getTimezone()->getName());

        $dt = new DateTime('2013-11-12', 'UTC');
        $this->assertEquals('2013-11-12 00:00:00', $dt->format());
        $this->assertEquals('UTC', $dt->getTimezone()->getName());

        $dt = DateTime::make('2013-11-12', 'UTC');
        $this->assertEquals('2013-11-12 00:00:00', $dt->format());
        $this->assertEquals('UTC', $dt->getTimezone()->getName());
    }

    /**
     * @dataProvider fromFormatProvider
     *
     * @covers ::fromFormat
     *
     * @param string $format
     * @param string $dateTime
     * @param string $timezone
     * @param string $expected
     */
    public function testFromFormat($format, $dateTime, $timezone, $expected)
    {
        try {
            /** @var DateTime $date */
            $date = DateTime::fromFormat($format, $dateTime, $timezone);
            $thrown = false;
        } catch (\Exception $e) {
            $thrown = true;
            $date = null;
        }

        if ($expected === null) {
            $this->assertSame(true, $thrown);
        } else {
            $this->assertSame($expected, $date->format(DateTime::ATOM));
        }
    }

    public function fromFormatProvider()
    {
        return [
          ['Y-m-d H:i:s', '2013-10-11 09:14:15', 'America/Los_Angeles', '2013-10-11T09:14:15-07:00'],
          ['Y-m-d H:i:s', '2013-10-11 09wrong:14:15', 'UTC', null],
        ];
    }

    /**
     * @dataProvider getLongDateProvider
     *
     * @covers ::getLongDate
     *
     * @param string $langCode
     * @param string $dateStr
     * @param string $expLong
     * @param string $expShort
     */
    public function testGetLongDate($langCode, $dateStr, $expLong, $expShort)
    {
        $dt = new DateTime($dateStr);

        $this->assertEquals($expShort, $dt->getLongDate($langCode));
        $this->assertEquals($expLong, $dt->getLongDate($langCode, DateTime::TIME_FORMAT_SHORT));
    }

    public function getLongDateProvider()
    {
        return [
          ['en', '2013-11-12 12:13:14', 'Tuesday, 12 November 2013, 12:13', 'Tuesday, 12 November 2013'],
          ['pl', '2013-11-12 12:13:14', 'Wtorek, 12 Listopad 2013, 12:13', 'Wtorek, 12 Listopad 2013'],
        ];
    }

    /**
     * @dataProvider jsonSerializeProvider
     *
     * @covers ::jsonSerialize
     * @covers ::targetSerialize
     * @covers ::format
     * @covers ::__toString
     *
     * @param string $class
     * @param string $dateStr
     * @param string $expected
     */
    public function testJsonSerialize($class, $dateStr, $expected)
    {
        /** @var DateTime $date */
        $date = new $class($dateStr);
        $this->assertEquals($expected, json_encode($date));
        $this->assertEquals(trim($expected, '"'), $date->__toString());
        $this->assertEquals(trim($expected, '"'), $date->targetSerialize());
    }

    public function jsonSerializeProvider()
    {
        return array(
            array('Kicaj\\Tools\\Date\\DateTime', '2013-09-22 09:08:10', '"2013-09-22 09:08:10"'),
            array('Kicaj\\Tools\\Date\\DateTimeDMY', '2013-09-22 09:08:10', '"22-09-2013"'),
            array('Kicaj\\Tools\\Date\\DateTimeDMYHIS', '2013-09-22 09:08:10', '"22-09-2013 09:08:10"'),
            array('Kicaj\\Tools\\Date\\DateTimeYMD', '2013-09-22 09:08:10', '"2013-09-22"'),
            array('Kicaj\\Tools\\Date\\DateTimeYMDHI', '2013-09-22 09:08:10', '"2013-09-22 09:08"'),
        );
    }

    /**
     * @dataProvider getMonthDeltaProvider
     *
     * @covers ::getCalMonthDelta
     * @covers ::addMonths
     *
     * @param int    $delta
     * @param int    $expected
     * @param string $expDate
     */
    public function testGetMonthDelta($delta, $expected, $expDate)
    {
        $date = new DateTimeYMD('2011-10-30');
        $got = $date->getCalMonthDelta($delta);
        $this->assertSame($expected, $got);

        $date->addMonths($delta);
        $this->assertSame($expDate, $date->format());

        $this->assertSame('00:00:00', $date->format('H:i:s'));
    }

    public function getMonthDeltaProvider()
    {
        return [
          [0, 10, '2011-10-30'],
          [1, 11, '2011-11-30'],
          [2, 12, '2011-12-30'],
          [3, 1, '2012-01-30'],

          [4, 2, '2012-03-01'],
          [5, 3, '2012-03-30'],
          [6, 4, '2012-04-30'],

          [29, 3, '2014-03-30'],

          [-1, 9, '2011-09-30'],
          [-2, 8, '2011-08-30'],
          [-3, 7, '2011-07-30'],
          [-4, 6, '2011-06-30'],
          [-5, 5, '2011-05-30'],
          [-6, 4, '2011-04-30'],
          [-7, 3, '2011-03-30'],
          [-8, 2, '2011-03-02'],
          [-9, 1, '2011-01-30'],
          [-10, 12, '2010-12-30'],
          [-11, 11, '2010-11-30'],

          [-26, 8, '2009-08-30'],
        ];
    }

    /**
     * @dataProvider secondsSinceMidnightProvider
     *
     * @covers ::secondsSinceMidnight
     *
     * @param string $dateTime
     * @param int    $expected
     */
    public function testSecondsSinceMidnight($dateTime, $expected)
    {
        $dt = new DateTime($dateTime);
        $this->assertSame($expected, $dt->secondsSinceMidnight());
    }

    public function secondsSinceMidnightProvider()
    {
        return [
            ['2013-09-22 00:00:59', 59],
            ['2013-09-22 00:01:00', 60],
            ['2013-09-22 01:00:09', 3609],
            ['2013-10-11 13:14:15', 47655],
        ];
    }

    /**
     * @dataProvider YMDHMSProvider
     *
     * @covers ::getYear
     * @covers ::getMonth
     * @covers ::getDay
     * @covers ::getDayOw
     * @covers ::getHours
     * @covers ::getMinutes
     * @covers ::getSeconds
     *
     * @param int $dateTime
     * @param int $yearL
     * @param int $yearS
     * @param int $month
     * @param int $day
     * @param int $dow
     * @param int $hour
     * @param int $minute
     * @param int $second
     */
    public function testYearMonthDayHoursMinutesSeconds($dateTime, $yearL, $yearS, $month, $day, $dow, $hour, $minute, $second)
    {
        $dt = new DateTime($dateTime);
        $this->assertSame($yearL, $dt->getYear());
        $this->assertSame($yearL, $dt->getYear(DateTime::YEAR_FORMAT_LONG));
        $this->assertSame($yearS, $dt->getYear(DateTime::YEAR_FORMAT_SHORT));
        $this->assertSame($month, $dt->getMonth());
        $this->assertSame($day, $dt->getDay());
        $this->assertSame($dow, $dt->getDayOw());
        $this->assertSame($hour, $dt->getHours());
        $this->assertSame($minute, $dt->getMinutes());
        $this->assertSame($second, $dt->getSeconds());
    }

    public function YMDHMSProvider()
    {
        return [
          ['2016-03-22 01:29:59', 2016, 16, 3, 22, 2, 1, 29, 59],
        ];
    }

    /**
     * @covers ::getYear
     * @covers ::getMonth
     * @covers ::getDay
     * @covers ::getDayOw
     * @covers ::getHours
     * @covers ::getMinutes
     * @covers ::getSeconds
     * @covers ::getLongDate
     */
    public function test_hollow()
    {
        $dt = DateTime::hollow();
        $this->assertSame(0, $dt->getYear());
        $this->assertSame(0, $dt->getYear());
        $this->assertSame(0, $dt->getYear());
        $this->assertSame(0, $dt->getMonth());
        $this->assertSame(0, $dt->getDay());
        $this->assertSame(0, $dt->getDayOw());
        $this->assertSame(0, $dt->getHours());
        $this->assertSame(0, $dt->getMinutes());
        $this->assertSame(0, $dt->getSeconds());
        $this->assertSame('', $dt->getLongDate('pl'));
    }

    /**
     * @dataProvider mysqlDateProvider
     *
     * @covers ::toMySQLDate
     *
     * @param string $dateTime
     * @param string $expWithTime
     * @param string $expWithoutTime
     */
    public function testMySqlDate($dateTime, $expWithTime, $expWithoutTime)
    {
        $dt = new DateTime($dateTime);
        $this->assertSame($expWithTime, $dt->toMySQLDate());
        $this->assertSame($expWithTime, $dt->toMySQLDate(true));
        $this->assertSame($expWithoutTime, $dt->toMySQLDate(false));

        $dt = new DateTimeDMY($dateTime);
        $this->assertSame($expWithTime, $dt->toMySQLDate());
        $this->assertSame($expWithTime, $dt->toMySQLDate(true));
        $this->assertSame($expWithoutTime, $dt->toMySQLDate(false));

        $dt = new DateTimeDMYHIS($dateTime);
        $this->assertSame($expWithTime, $dt->toMySQLDate());
        $this->assertSame($expWithTime, $dt->toMySQLDate(true));
        $this->assertSame($expWithoutTime, $dt->toMySQLDate(false));

        $dt = new DateTimeYMD($dateTime);
        $this->assertSame($expWithTime, $dt->toMySQLDate());
        $this->assertSame($expWithTime, $dt->toMySQLDate(true));
        $this->assertSame($expWithoutTime, $dt->toMySQLDate(false));

        $dt = new DateTimeYMDHI($dateTime);
        $this->assertSame($expWithTime, $dt->toMySQLDate());
        $this->assertSame($expWithTime, $dt->toMySQLDate(true));
        $this->assertSame($expWithoutTime, $dt->toMySQLDate(false));
    }

    public function mysqlDateProvider()
    {
        return [
          ['2016-03-22 01:29:59', '2016-03-22 01:29:59', '2016-03-22'],
        ];
    }

    /**
     * @covers ::getCurrentYear
     */
    public function testGetCurrentYear()
    {
        $yearL = (int) date('Y');
        $yearS = (int) date('y');
        $this->assertSame($yearL, DateTime::getCurrentYear(true));
        $this->assertSame($yearS, DateTime::getCurrentYear(true, DateTime::YEAR_FORMAT_SHORT));
    }

    /**
     * @covers ::getCurrentMonth
     */
    public function testGetCurrentMonth()
    {
        $month = (int) date('m');
        $this->assertSame($month, DateTime::getCurrentMonth(true));
    }

    /**
     * @covers ::getCurrentHour
     */
    public function testGetCurrentHour()
    {
        $hour = (int) date('G');

        $this->assertNotSame($hour, DateTime::getCurrentHour(true));
        $this->assertSame($hour, DateTime::getCurrentHour());
    }

    /**
     * @covers ::getCurrentMinutes
     */
    public function testGetCurrentMinutes()
    {
        date_default_timezone_set('Asia/Kathmandu');
        $minutes = (int) date('i');

        $this->assertNotSame($minutes, DateTime::getCurrentMinutes(true));
        $this->assertSame($minutes, DateTime::getCurrentMinutes());
    }

    /**
     * @covers ::now
     */
    public function testNow()
    {
        $now = time();
        $this->assertSame($now, DateTime::now()->getTimestamp());
        $this->assertSame($now, DateTimeDMY::now()->getTimestamp());
        $this->assertSame($now, DateTimeDMYHIS::now()->getTimestamp());
        $this->assertSame($now, DateTimeYMD::now()->getTimestamp());
        $this->assertSame($now, DateTimeYMDHI::now()->getTimestamp());
    }

    /**
     * @covers ::__construct
     * @covers ::hollow
     * @covers ::format
     * @covers ::setHollow
     * @covers ::getFormat
     * @covers ::toMySQLDate
     */
    public function testHollowNew()
    {
        $date = new DateTime('');

        $this->assertNotNull($date);
        $this->assertTrue($date->isHollow());
        $this->assertSame('', $date->getFormat());

        $this->assertSame('', $date->getLongDate('en'));
        $this->assertSame('', $date->format());
        $this->assertSame('', $date->format('Y-m-d H:i:s'));
        $this->assertSame('', $date->__toString());
        $this->assertSame('', $date->jsonSerialize());

        $this->assertSame(0, $date->secondsSinceMidnight());
        $this->assertSame('0000-00-00 00:00:00', $date->toMySQLDate());

        $this->assertSame(0, $date->getYear());

        $this->assertSame(0, $date->getHours());
        $this->assertSame(0, $date->getMinutes());
        $this->assertSame(0, $date->getSeconds());

        $date->setHollow(false);
        $this->assertFalse($date->isHollow());
        $this->assertSame('Y-m-d H:i:s', $date->getFormat());
    }

    /**
     * @covers ::hollow
     * @covers ::format
     * @covers ::setHollow
     * @covers ::getFormat
     * @covers ::toMySQLDate
     */
    public function testHollowStatic()
    {
        $date = DateTime::hollow();

        $this->assertNotNull($date);
        $this->assertTrue($date->isHollow());
        $this->assertSame('', $date->getFormat());

        $this->assertSame('', $date->getLongDate('en'));
        $this->assertSame('', $date->format());
        $this->assertSame('', $date->format('Y-m-d H:i:s'));
        $this->assertSame('', $date->__toString());
        $this->assertSame('', $date->jsonSerialize());

        $this->assertSame(0, $date->secondsSinceMidnight());
        $this->assertSame('0000-00-00 00:00:00', $date->toMySQLDate());

        $this->assertSame(0, $date->getYear());

        $this->assertSame(0, $date->getHours());
        $this->assertSame(0, $date->getMinutes());
        $this->assertSame(0, $date->getSeconds());

        $date->setHollow(false);
        $this->assertFalse($date->isHollow());
        $this->assertSame('Y-m-d H:i:s', $date->getFormat());
    }
}
