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

use Kicaj\Tools\Date\DateTime;

/**
 * Class DateTime_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Date\DateTime
 *
 * @author             Rafal Zajac <rzajac@gmail.com>
 */
class DateTime_Test extends \PHPUnit_Framework_TestCase
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
        // Current time zone.
        $this->defaultTz = date_default_timezone_get();

        // Pick and set time zone that is not UTC.
        $tz = array_diff(['Europe/Warsaw', 'Brazil/Acre'], [$this->defaultTz]);
        $this->setTz = reset($tz);
        date_default_timezone_set($this->setTz);
    }

    protected function tearDown()
    {
        // Set time zone to what it was set before the test.
        date_default_timezone_set($this->defaultTz);
    }

    /**
     * @covers ::__construct
     */
    public function test___construct_default_tz()
    {
        // When
        $dt = new DateTime('2013-11-12');

        // Then
        $this->assertEquals($this->setTz, $dt->getTimezone()->getName());
    }

    /**
     * @covers ::make
     */
    public function test_make_default_tz()
    {
        // When
        $dt = new DateTime('2017-11-13');

        // Then
        $this->assertEquals($this->setTz, $dt->getTimezone()->getName());
    }

    /**
     * @dataProvider constructMakeProvider
     *
     * @covers ::__construct
     *
     * @param string      $time
     * @param string      $expTime
     * @param string|null $tz
     * @param string      $expTz
     */
    public function test___construct($time, $expTime, $tz, $expTz)
    {
        // When
        $dt = new DateTime($time, $tz);

        // Then
        $this->assertEquals($expTime, $dt->format());
        $this->assertEquals($expTz, $dt->getTimezone()->getName());
    }

    /**
     * @dataProvider constructMakeProvider
     *
     * @covers ::make
     *
     * @param string      $time
     * @param string      $expTime
     * @param string|null $tz
     * @param string      $expTz
     */
    public function test_make($time, $expTime, $tz, $expTz)
    {
        // When
        $dt = DateTime::make($time, $tz);

        // Then
        $this->assertEquals($expTime, $dt->format());
        $this->assertEquals($expTz, $dt->getTimezone()->getName());
    }

    public function constructMakeProvider()
    {
        return [
            ['2013-11-12', '2013-11-12 00:00:00', 'Europe/Warsaw', 'Europe/Warsaw'],
            ['2013-11-12', '2013-11-12 00:00:00', 'UTC', 'UTC'],
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
    public function test_getLongDate($langCode, $dateStr, $expLong, $expShort)
    {
        // When
        $dt = new DateTime($dateStr);

        // Then
        $this->assertEquals($expShort, $dt->getLongDate($langCode));
        $this->assertEquals($expLong, $dt->getLongDate($langCode, DateTime::TIME_FORMAT_SHORT));
    }

    public function getLongDateProvider()
    {
        return [
            ['en', '2013-11-12 12:13:14', 'Tuesday, 12 November 2013, 12:13', 'Tuesday, 12 November 2013'],
            ['pl', '2013-11-12 12:13:14', 'Wtorek, 12 Listopad 2013, 12:13', 'Wtorek, 12 Listopad 2013'],

            // Hollow
            ['en', '', '', ''],
            ['pl', '', '', ''],
        ];
    }

    /**
     * @dataProvider secondsSinceMidnightProvider
     *
     * @covers ::secondsSinceMidnight
     *
     * @param string $dateTime
     * @param int    $secondsSinceMidnight
     */
    public function test_secondsSinceMidnight($dateTime, $secondsSinceMidnight)
    {
        // When
        $dt = new DateTime($dateTime);

        // Then
        $this->assertSame($secondsSinceMidnight, $dt->secondsSinceMidnight());
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
     * @param string $dateTime
     * @param int    $yearL
     * @param int    $yearS
     * @param int    $month
     * @param int    $day
     * @param int    $dow
     * @param int    $hour
     * @param int    $minute
     * @param int    $second
     */
    public function test_YearMonthDayHoursMinutesSeconds(
        $dateTime,
        $yearL,
        $yearS,
        $month,
        $day,
        $dow,
        $hour,
        $minute,
        $second
    ) {
        // When
        $dt = new DateTime($dateTime);

        // Then
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

            // Hollow
            ['', 0, 0, 0, 0, 0, 0, 0, 0],
        ];
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
    public function test_toMySQLDate($dateTime, $expWithTime, $expWithoutTime)
    {
        // When
        $dt = new DateTime($dateTime);

        // Then
        $this->assertSame($expWithTime, $dt->toMySQLDate());
        $this->assertSame($expWithTime, $dt->toMySQLDate(true));
        $this->assertSame($expWithoutTime, $dt->toMySQLDate(false));
    }

    public function mysqlDateProvider()
    {
        return [
            ['', '0000-00-00 00:00:00', '0000-00-00'], // Hollow date
            ['2016-03-22 01:29:59', '2016-03-22 01:29:59', '2016-03-22'],
        ];
    }


    /**
     * @covers ::getCurrentYear
     */
    public function test_getCurrentYear()
    {
        // When
        $yearL = (int)date('Y');
        $yearS = (int)date('y');

        // Then
        $this->assertSame($yearL, DateTime::getCurrentYear(true));
        $this->assertSame($yearS, DateTime::getCurrentYear(true, DateTime::YEAR_FORMAT_SHORT));
    }

    /**
     * @covers ::getCurrentMonth
     */
    public function test_getCurrentMonth()
    {
        // When
        $month = (int)date('m');

        // Then
        $this->assertSame($month, DateTime::getCurrentMonth(true));
    }

    /**
     * @covers ::getCurrentHour
     */
    public function test_getCurrentHour()
    {
        // When
        $hour = (int)date('G');

        // Then
        $this->assertNotSame($hour, DateTime::getCurrentHour(true));
        $this->assertSame($hour, DateTime::getCurrentHour());
    }

    /**
     * @covers ::getCurrentMinutes
     */
    public function test_getCurrentMinutes()
    {
        // Given
        date_default_timezone_set('Asia/Kathmandu');

        // When
        $minutes = (int)date('i');

        // Then
        $this->assertNotSame($minutes, DateTime::getCurrentMinutes(true));
        $this->assertSame($minutes, DateTime::getCurrentMinutes());
    }

    /**
     * @covers ::now
     * @covers ::getTimestamp
     */
    public function test_now()
    {
        // When
        $now = time();

        // Then
        $this->assertSame($now, DateTime::now()->getTimestamp());
    }

    /**
     * @covers ::__construct
     */
    public function test_new_hollow()
    {
        // When
        $date = new DateTime('');

        // Then
        $this->myTestHollow($date);
    }

    /**
     * @covers ::hollow
     */
    public function test_hollow_static()
    {
        // When
        $date = DateTime::hollow();

        // Then
        $this->myTestHollow($date);
    }

    /**
     * Helper method to test hollow dates.
     *
     * @param DateTime $date
     */
    public function myTestHollow(DateTime $date)
    {
        $this->assertNotNull($date);

        $this->assertTrue($date->isHollow());

        $this->assertSame('', $date->getFormat());

        // Any format should return empty string.
        $this->assertSame('', $date->format());
        $this->assertSame('', $date->format('Y-m-d H:i:s'));

        $this->assertSame('', $date->__toString());
        $this->assertSame('', $date->jsonSerialize());

        $this->assertSame(0, $date->secondsSinceMidnight());
        $this->assertSame('0000-00-00 00:00:00', $date->toMySQLDate());

        $this->assertSame(0, $date->getYear());
        $this->assertSame(0, $date->getMonth());
        $this->assertSame(0, $date->getDay());
        $this->assertSame(0, $date->getDayOw());

        $this->assertSame(0, $date->getHours());
        $this->assertSame(0, $date->getMinutes());
        $this->assertSame(0, $date->getSeconds());

        $this->assertSame('', $date->getLongDate('en'));
        $this->assertSame('', $date->getLongDate('pl'));
    }

    /**
     * @dataProvider isWeekendProvider
     *
     * @covers ::isWeekend
     * @covers ::isWorkday
     *
     * @param string $date
     * @param bool   $isWeekend
     */
    public function test_isWeekend($date, $isWeekend)
    {
        // When
        $date = new DateTime($date);

        // Then
        $this->assertSame($isWeekend, $date->isWeekend());
        $this->assertSame(!$isWeekend, $date->isWorkDay());
    }

    public function isWeekendProvider()
    {
        return [
            ['2015-12-07', false],
            ['2015-12-08', false],
            ['2015-12-09', false],
            ['2015-12-10', false],
            ['2015-12-11', false],
            ['2015-12-12', true],
            ['2015-12-13', true],
            ['2015-12-14', false],
        ];
    }

    /**
     * @dataProvider isPastProvider
     *
     * @covers ::isPast
     * @covers ::isFuture
     *
     * @param string $date
     * @param false  $isPast
     */
    public function test_isPast($date, $isPast)
    {
        // Given
        // When
        $dt = new DateTime($date);

        // Then
        $this->assertSame($isPast, $dt->isPast());
        $this->assertSame(!$isPast, $dt->isFuture());
    }

    public function isPastProvider()
    {
        return [
            ['1980-08-12', true],
            ['2130-08-12', false],
        ];
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
    public function test_fromFormat($format, $dateTime, $timezone, $expected)
    {
        // When
        $dt = null;
        try {
            $gotErrMsg = '';
            /** @var DateTime $dt */
            $dt = DateTime::fromFormat($format, $dateTime, $timezone);
        } catch (\Exception $e) {
            $gotErrMsg = $e->getMessage();
        }

        // Then
        if ($gotErrMsg) {
            $this->assertSame(null, $dt);
            $this->assertSame('Unexpected data found.', $gotErrMsg);
        } else {
            $this->assertSame($expected, $dt->format(DateTime::ATOM));
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
     * @dataProvider serializeProvider
     *
     * @covers ::__toString
     *
     * @param string $dateStr
     * @param string $expected
     */
    public function test__toString($dateStr, $expected)
    {
        // When
        $dt = new DateTime($dateStr);

        // Then
        $this->assertEquals($expected, $dt->__toString());
    }

    /**
     * @dataProvider serializeProvider
     *
     * @covers ::targetSerialize
     *
     * @param string $dateStr
     * @param string $expected
     *
     * @throws \Exception
     */
    public function test_targetSerialize($dateStr, $expected)
    {
        // When
        $dt = new DateTime($dateStr);

        // Then
        $this->assertEquals($expected, $dt->targetSerialize());
    }

    /**
     * @dataProvider serializeProvider
     *
     * @covers ::jsonSerialize
     *
     * @param string $dateStr
     * @param string $expected
     */
    public function test_jsonSerialize($dateStr, $expected)
    {
        // When
        $dt = new DateTime($dateStr);

        // Then
        $this->assertEquals('"' . $expected . '"', json_encode($dt));
    }

    public function serializeProvider()
    {
        return [
            ['2013-09-22 09:08:10', '2013-09-22 09:08:10'],
        ];
    }

    /**
     * @dataProvider monthsDeltaProvider
     *
     * @covers ::getCalMonthDelta
     *
     * @param string $givenDate
     * @param int    $monthDelta
     * @param int    $expMonth
     * @param string $expDate Not used in this test.
     */
    public function test_getMonthDelta($givenDate, $monthDelta, $expMonth, $expDate)
    {
        // Given
        $dt = new DateTime($givenDate);

        // When
        $got = $dt->getCalMonthDelta($monthDelta);

        // Then
        $this->assertSame($expMonth, $got);
        $this->assertSame('00:00:00', $dt->format('H:i:s'));
    }

    /**
     * @dataProvider monthsDeltaProvider
     *
     * @covers ::addMonths
     *
     * @param string $givenDate
     * @param int    $monthDelta
     * @param int    $expectedMonth
     * @param string $expectedDate
     */
    public function test_addMonths($givenDate, $monthDelta, $expectedMonth, $expectedDate)
    {
        // Given
        $dt = new DateTime($givenDate);

        // When
        $dt->addMonths($monthDelta);

        // Then
        $this->assertSame($expectedDate, $dt->format());
        $this->assertSame($expectedMonth, $dt->getMonth());
        $this->assertSame('00:00:00', $dt->format('H:i:s'));
    }

    public function monthsDeltaProvider()
    {
        return [
            // date, monthDelta, expectedMonth, expectedDate
            ['2011-10-30', 0, 10, '2011-10-30 00:00:00'],
            ['2011-10-30', 1, 11, '2011-11-30 00:00:00'],
            ['2011-10-30', 2, 12, '2011-12-30 00:00:00'],
            ['2011-10-30', 3, 1, '2012-01-30 00:00:00'],

            // Calculations for february.
            ['2011-10-30', 4, 3, '2012-03-01 00:00:00'],
            ['2011-10-29', 4, 2, '2012-02-29 00:00:00'],
            ['2011-10-28', 4, 2, '2012-02-28 00:00:00'],
            ['2014-10-28', 4, 2, '2015-02-28 00:00:00'],
            ['2014-10-28', -8, 2, '2014-02-28 00:00:00'],
            ['2014-10-29', -8, 3, '2014-03-01 00:00:00'],

            ['2011-10-30', 5, 3, '2012-03-30 00:00:00'],
            ['2011-10-30', 6, 4, '2012-04-30 00:00:00'],

            ['2011-10-30', 29, 3, '2014-03-30 00:00:00'],

            ['2011-10-30', -1, 9, '2011-09-30 00:00:00'],
            ['2011-10-30', -2, 8, '2011-08-30 00:00:00'],
            ['2011-10-30', -3, 7, '2011-07-30 00:00:00'],
            ['2011-10-30', -4, 6, '2011-06-30 00:00:00'],
            ['2011-10-30', -5, 5, '2011-05-30 00:00:00'],
            ['2011-10-30', -6, 4, '2011-04-30 00:00:00'],
            ['2011-10-30', -7, 3, '2011-03-30 00:00:00'],
            ['2011-10-30', -8, 3, '2011-03-02 00:00:00'],
            ['2011-10-30', -9, 1, '2011-01-30 00:00:00'],
            ['2011-10-30', -10, 12, '2010-12-30 00:00:00'],
            ['2011-10-30', -11, 11, '2010-11-30 00:00:00'],

            ['2011-10-30', -26, 8, '2009-08-30 00:00:00'],
        ];
    }

    /**
     * @covers ::getFormat
     */
    public function test_getFormat()
    {
        // When
        $dt = new DateTime();

        // Then
        $this->assertSame('Y-m-d H:i:s', $dt->getFormat());
    }

    /**
     * @covers ::format
     */
    public function test_format_hollow()
    {
        // When
        $dt = new DateTime('');

        // Then
        $this->assertSame('', $dt->format());
    }

    /**
     * @covers ::setHollow
     */
    public function test_setHollow_true()
    {
        // Given
        $dt = new DateTime('2020-10-12');

        // When
        $dt->setHollow();

        // Then
        $this->assertSame('', $dt->getFormat());
    }

    /**
     * @covers ::setHollow
     */
    public function test_setHollow_true_false()
    {
        // Given
        $dt = new DateTime('2020-10-12');

        // When
        $dt->setHollow();
        $dt->setHollow(false);

        // Then
        $this->assertSame('Y-m-d H:i:s', $dt->getFormat());
    }

    /**
     * @covers ::format
     */
    public function test_format_hollow_not_hollow()
    {
        // Given
        $dt = new DateTime('');

        // When
        $dt->setHollow(false);

        // Then
        $this->assertSame('1970-01-01 00:00:00', $dt->format());
    }

    /**
     * @covers ::format
     */
    public function test_format_default_format()
    {
        // When
        $dt = new DateTime('1956-11-12');

        // Then
        $this->assertSame('1956-11-12 00:00:00', $dt->format());
    }

    /**
     * @covers ::format
     */
    public function test_format_custom_format()
    {
        // When
        $dt = new DateTime('1956-11-12');

        // Then
        $this->assertSame('1956:11:12', $dt->format('Y:m:d'));
    }
}
