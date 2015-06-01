<?php
/**
 * Copyright 2015 Rafal Zajac <rzajac@gmail.com>
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

namespace Kicaj\Tools\Date;

use DateInterval;
use DateTimeZone;
use Kicaj\Tools\Itf\Hollow as IHollow;
use Kicaj\Tools\Itf\TargetSerialize;
use Kicaj\Tools\Lang\Calendar;
use Kicaj\Tools\Traits\Hollow;

/**
 * Date and time base class
 *
 * @package Kicaj\Tools\Date
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class DateTime extends \DateTime implements IHollow, TargetSerialize
{
    use Hollow { setHollow as traitSetHollow; }

    /** Four digit year */
    const YEAR_FORMAT_LONG = 'Y';

    /** Two digit year */
    const YEAR_FORMAT_SHORT = 'y';

    /** Long time format (with seconds) */
    const TIME_FORMAT_LONG = 'H:i:s';

    /** Short time format (without seconds) */
    const TIME_FORMAT_SHORT = 'H:i';

    /**
     * Default serialization format
     *
     * @var string
     */
    protected $format = 'Y-m-d H:i:s';

    /**
     * Backup of default serialization format
     *
     * @var string
     */
    private $formatBack;

    /**
     * Constructor
     *
     * @param string                   $time        The time
     * @param DateTimeZone|string|null $timezone    The DateTimeZone instance or timezone name ex.: UTC.
     *                                              If null the default timezone will be used
     *
     * @see http://php.net/timezones
     */
    public function __construct($time = 'now', $timezone = null)
    {
        if (is_string($timezone) && $timezone !== '')
        {
            $timezone = new DateTimeZone($timezone);
        }

        $this->formatBack = $this->format;

        if(!$time)
        {
            $time = '1970-01-01 00:00:00';
            $timezone = new DateTimeZone('UTC');
            $this->setHollow();
        }

        parent::__construct($time, $timezone);
    }

    /**
     * Make
     *
     * @param string                   $time        The time
     * @param DateTimeZone|string|null $timezone    The DateTimeZone instance or timezone name ex.: UTC.
     *                                              If null the default timezone will be taken
     * @param bool                     $addZeroHour Set to true to add 00:00:00 to the passed date
     *
     * @return static
     */
    public static function make($time = 'now', $timezone = null, $addZeroHour = false)
    {
        return new static($time, $timezone, $addZeroHour);
    }

    /**
     * Return current time
     *
     * @param DateTimeZone|string|null $timezone    The DateTimeZone instance or timezone name ex.: UTC.
     *                                              If null the default timezone will be taken
     *
     * @return static
     */
    public static function now($timezone = null)
    {
        return new static('now', $timezone);
    }

    /**
     * Make hollow date
     *
     * @return static
     */
    public static function hollow()
    {
        return new DateTime('');
    }

    /**
     * Set DateTime as hollow / empty
     *
     * @param bool $flag Set to true to make object hollow / empty
     *
     * @return $this
     */
    public function setHollow($flag = true)
    {
        $this->traitSetHollow($flag);

        if($flag)
        {
            $this->format = '';
        }
        else
        {
            $this->format = $this->formatBack;
        }

        return $this;
    }

    /**
     * Parse a string into a new DateTime object according to the specified format
     *
     * This is basically the same method as parent's createFromFormat but allows
     * passing time zone as string.
     *
     * @link http://php.net/manual/en/datetime.createfromformat.php
     *
     * @param string                   $format      Format accepted by date()
     * @param string                   $time        String representing the time
     * @param DateTimeZone|string|null $timezone    The DateTimeZone instance or timezone name ex.: UTC.
     *                                              If null the default timezone will be taken
     *
     * @throws \Exception
     *
     * @return static
     */
    public static function fromFormat($format, $time, $timezone = null)
    {
        if (is_string($timezone))
        {
            $timezone = new DateTimeZone($timezone);
        }

        // DateTime::createFromFormat() expects parameter 3 to be DateTimeZone, null given
        $dt = $timezone ? DateTime::createFromFormat($format, $time, $timezone) :  DateTime::createFromFormat($format, $time);

        if (! $dt)
        {
            $errorMsg = DateTime::getLastErrors();
            $errorMsg = array_values($errorMsg['errors'])[0];
            throw new \Exception($errorMsg);
        }

        $object = new static('now', $dt->getTimezone());
        return $object->setTimestamp($dt->getTimestamp());
    }

    /**
     * Get date format string
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Format date as Saturday, 20 April 2013, 16:23
     *
     * @param  string  $languageCode The language code ex: pl, en
     * @param  boolean $timeFormat   Tho one of self::TIME_FORMAT_* constants
     *
     * @return string             The formatted date
     */
    public function getLongDate($languageCode, $timeFormat = null)
    {
        if ($this->isHollow()) return '';

        $dayName = Calendar::getDay($this->getDayOw(), $languageCode);
        $monthName = Calendar::getMonth($this->getMonth(), $languageCode);

        $dateStr = $dayName . ', ' . $this->format('j') . ' ' . $monthName . ' ' . $this->format('Y');

        if ($timeFormat)
        {
            $dateStr .= ', ' . $this->format($timeFormat);
        }

        return $dateStr;
    }

    /**
     * Return number of seconds since midnight.
     *
     * @return int
     */
    public function secondsSinceMidnight()
    {
        return $this->getHours() * 3600 + $this->getMinutes() * 60 + $this->getSeconds();
    }

    /**
     * Returns date in MySQL format
     *
     * NOTE: It returns 0000-00-00 00:00:00 for hollow dates
     *
     * @param bool $withTime
     *
     * @return string
     */
    public function toMySQLDate($withTime = true)
    {
        if ($this->isHollow())
        {
            return $withTime ? '0000-00-00 00:00:00' : '0000-00-00';
        }

        $format = $withTime ? 'Y-m-d H:i:s' : 'Y-m-d';

        return $this->format($format);
    }

    /**
     * Get year
     *
     * @param string $format The one of self::YEAR_FORMAT_* constants
     *
     * @return int
     */
    public function getYear($format = self::YEAR_FORMAT_LONG)
    {
        if($this->isHollow()) return 0;

        return (int) $this->format($format);
    }

    /**
     * Get month
     *
     * @return int
     */
    public function getMonth()
    {
        if($this->isHollow()) return 0;

        return (int) $this->format('n');
    }

    /**
     * Get day
     *
     * @return int
     */
    public function getDay()
    {
        if($this->isHollow()) return 0;

        return (int) $this->format('j');
    }

    /**
     * Get day of the week
     *
     * @return int
     */
    public function getDayOw()
    {
        if($this->isHollow()) return 0;

        return (int) $this->format('w');
    }

    /**
     * Get hour
     *
     * @return int
     */
    public function getHours()
    {
        return (int) $this->format('G');
    }

    /**
     * Get minutes
     *
     * @return int
     */
    public function getMinutes()
    {
        return (int) $this->format('i');
    }

    /**
     * Get seconds
     *
     * @return int
     */
    public function getSeconds()
    {
        return (int) $this->format('s');
    }

    /**
     * Go x months before or ahead
     *
     * @param int $delta The number of months to add or subtract
     *
     * @return static
     */
    public function addMonths($delta)
    {
        $interval = new DateInterval('P' . abs($delta) . 'M');

        if ($delta >= 0)
        {
            $this->add($interval);
        }
        else
        {
            $this->sub($interval);
        }

        return $this;
    }

    /**
     * Get calendar month number being x months before or ahead
     *
     * @param int $delta The number of months to add or subtract
     *
     * @return int
     */
    public function getCalMonthDelta($delta = 0)
    {
        if ($delta <= -12 || $delta >= 12)
        {
            $delta = $delta % 12;
        }

        $month = $this->getMonth() + $delta;

        if ($month < 0)
        {
            $month = 12 + $month;
        }
        elseif ($month == 0)
        {
            $month = 12;
        }
        elseif ($month > 12)
        {
            $month = $month % 12;
        }

        return $month;
    }

    /**
     * Get current year
     *
     * @param bool   $inUTC
     * @param string $format
     *
     * @return int
     */
    public static function getCurrentYear($inUTC = false, $format = self::YEAR_FORMAT_LONG)
    {
        $tz = $inUTC ? 'UTC' : null;
        return (int) static::now($tz)->format($format);
    }

    /**
     * Get current month
     *
     * @param bool $inUTC
     *
     * @return int
     */
    public static function getCurrentMonth($inUTC = false)
    {
        $tz = $inUTC ? 'UTC' : null;
        return (int) static::now($tz)->format('n');
    }

    /**
     * Get current hour
     *
     * @param bool $inUTC
     *
     * @return int
     */
    public static function getCurrentHour($inUTC = false)
    {
        $tz = $inUTC ? 'UTC' : null;
        return (int) static::now($tz)->format('G');
    }

    /**
     * Get current minutes
     *
     * @param bool $inUTC
     *
     * @return int
     */
    public static function getCurrentMinutes($inUTC = false)
    {
        $tz = $inUTC ? 'UTC' : null;
        return (int) static::now($tz)->format('i');
    }

    /**
     * Format date.
     *
     * @param string $format Format accepted by date(). When empty it's using the default format.
     *
     * @return string
     */
    public function format($format = '')
    {
        if($this->isHollow())
        {
            $format = $this->format;
        }
        else
        {
            $format = $format ?: $this->format;
        }

        return parent::format($format);
    }

    /**
     * Returns date as string using formatting for the class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->format($this->format);
    }

    /**
     * Returns data which should be serialized to JSON
     *
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->format($this->format);
    }

    /**
     * Serialize object for given target
     *
     * @param string $target The serialization target (one of the TSer constants)
     * @param mixed  $params The additional parameters that serializer might need
     *
     * @throws \Exception
     * @return \stdClass|string|array|NULL
     */
    public function targetSerialize($target = self::SER_DEFAULT, $params = null)
    {
        return $this->format($this->format);
    }
}
