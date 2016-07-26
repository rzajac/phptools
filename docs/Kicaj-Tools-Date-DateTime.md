## Class Kicaj\Tools\Date\DateTime
Date and time base class.

## Extends

- DateTime

## Implements

- [Kicaj\Tools\Itf\Hollower](Kicaj-Tools-Itf-Hollower.md)
- [Kicaj\Tools\Itf\TargetSerializer](Kicaj-Tools-Itf-TargetSerializer.md)

## Uses traits

- [Kicaj\Tools\Traits\Hollow](Kicaj-Tools-Traits-Hollow.md)

## Constants

```php
const YEAR_FORMAT_LONG = 'Y';
const YEAR_FORMAT_SHORT = 'y';
const TIME_FORMAT_LONG = 'H:i:s';
const TIME_FORMAT_SHORT = 'H:i';
```

## Methods

|                                                |                                                |                                                |                                                |
| ---------------------------------------------- | ---------------------------------------------- | ---------------------------------------------- | ---------------------------------------------- |
|          [__construct](#__construct)           |                 [make](#make)                  |                  [now](#now)                   |               [hollow](#hollow)                |
|            [setHollow](#sethollow)             |           [fromFormat](#fromformat)            |            [getFormat](#getformat)             |          [getLongDate](#getlongdate)           |
| [secondsSinceMidnight](#secondssincemidnight)  |          [toMySQLDate](#tomysqldate)           |            [isWeekend](#isweekend)             |            [isWorkDay](#isworkday)             |
|              [getYear](#getyear)               |             [getMonth](#getmonth)              |               [getDay](#getday)                |             [getDayOw](#getdayow)              |
|             [getHours](#gethours)              |           [getMinutes](#getminutes)            |           [getSeconds](#getseconds)            |            [addMonths](#addmonths)             |
|     [getCalMonthDelta](#getcalmonthdelta)      |       [getCurrentYear](#getcurrentyear)        |      [getCurrentMonth](#getcurrentmonth)       |       [getCurrentHour](#getcurrenthour)        |
|    [getCurrentMinutes](#getcurrentminutes)     |               [format](#format)                |           [__toString](#__tostring)            |        [jsonSerialize](#jsonserialize)         |
|      [targetSerialize](#targetserialize)       |                     [](#)                      |                     [](#)                      |                     [](#)                      |

## Properties

|                              |                              |                              |
| ---------------------------- | ---------------------------- | ---------------------------- |
|      [$format](#format)      |  [$formatBack](#formatback)  |   [$_isHollow](#_ishollow)   |

-------

#### $format
Default serialization format.

```php
protected string $format = 'Y-m-d H:i:s'
```

#### $formatBack
Backup of default serialization format.

```php
protected string $formatBack
```

-------
## Methods
#### __construct
Constructor.
```php
public function __construct(string $time, DateTimeZone|string|null $timezone) : 
```
Arguments:
- _$time_ **string** - The time., 
- _$timezone_ **DateTimeZone|string|null** - The DateTimeZone instance or timezone name ex.: UTC.
                                             If null the default timezone will be used.

-------
#### make
Make.
```php
public static function make(string $time, DateTimeZone|string|null $timezone) : static
```
Arguments:
- _$time_ **string** - The time, 
- _$timezone_ **DateTimeZone|string|null** - The DateTimeZone instance or timezone name ex.: UTC.
                                             If null the default timezone will be taken

Returns: **static**

-------
#### now
Return current time.
```php
public static function now(DateTimeZone|string|null $timezone) : static
```
Arguments:
- _$timezone_ **DateTimeZone|string|null** - The DateTimeZone instance or timezone name ex.: UTC.
                                          If null the default timezone will be taken

Returns: **static**

-------
#### hollow
Make hollow date.
```php
public static function hollow() : static
```

Returns: **static**

-------
#### setHollow
Set DateTime as hollow / empty.
```php
public function setHollow(boolean $flag) : Kicaj\Tools\Date\DateTime
```
Arguments:
- _$flag_ **boolean** - Set to true to make object hollow / empty

Returns: **[Kicaj\Tools\Date\DateTime](Kicaj-Tools-Date-DateTime.md)**

-------
#### fromFormat
Parse a string into a new DateTime object according to the specified format.

This is basically the same method as parent&#039;s createFromFormat but allows
passing time zone as string.
```php
public static function fromFormat(string $format, string $time, DateTimeZone|string|null $timezone) : static
```
Arguments:
- _$format_ **string** - Format accepted by date(), 
- _$time_ **string** - String representing the time, 
- _$timezone_ **DateTimeZone|string|null** - The DateTimeZone instance or timezone name ex.: UTC.
                                          If null the default timezone will be taken

Throws:
- [Kicaj\Tools\Exception](Kicaj-Tools-Exception.md)

Returns: **static**

-------
#### getFormat
Get date format string.
```php
public function getFormat() : string
```

Returns: **string**

-------
#### getLongDate
Format date as Saturday, 20 April 2013, 16:23.
```php
public function getLongDate(string $languageCode, boolean $timeFormat) : string
```
Arguments:
- _$languageCode_ **string** - The language code ex: pl, en, 
- _$timeFormat_ **boolean** - Tho one of self::TIME_FORMAT_* constants

Returns: **string** - The formatted date

-------
#### secondsSinceMidnight
Return number of seconds since midnight.
```php
public function secondsSinceMidnight() : integer
```

Returns: **integer**

-------
#### toMySQLDate
Returns date in MySQL format.

NOTE: It returns 0000-00-00 00:00:00 for hollow dates
```php
public function toMySQLDate(boolean $withTime) : string
```
Arguments:
- _$withTime_ **boolean**

Returns: **string**

-------
#### isWeekend
Returns true if date is on saturday or sunday.
```php
public function isWeekend() : boolean
```

Returns: **boolean**

-------
#### isWorkDay
Returns true if date is on monday through friday.
```php
public function isWorkDay() : boolean
```

Returns: **boolean**

-------
#### getYear
Get year.
```php
public function getYear(string $format) : integer
```
Arguments:
- _$format_ **string** - The one of self::YEAR_FORMAT_* constants

Returns: **integer**

-------
#### getMonth
Get month.
```php
public function getMonth() : integer
```

Returns: **integer**

-------
#### getDay
Get day.
```php
public function getDay() : integer
```

Returns: **integer**

-------
#### getDayOw
Get day of the week.
```php
public function getDayOw() : integer
```

Returns: **integer**

-------
#### getHours
Get hour.
```php
public function getHours() : integer
```

Returns: **integer**

-------
#### getMinutes
Get minutes.
```php
public function getMinutes() : integer
```

Returns: **integer**

-------
#### getSeconds
Get seconds.
```php
public function getSeconds() : integer
```

Returns: **integer**

-------
#### addMonths
Go x months before or ahead.
```php
public function addMonths(integer $delta) : static
```
Arguments:
- _$delta_ **integer** - The number of months to add or subtract

Returns: **static**

-------
#### getCalMonthDelta
Get calendar month number being x months before or ahead.
```php
public function getCalMonthDelta(integer $delta) : integer
```
Arguments:
- _$delta_ **integer** - The number of months to add or subtract

Returns: **integer**

-------
#### getCurrentYear
Get current year.
```php
public static function getCurrentYear(boolean $inUTC, string $format) : integer
```
Arguments:
- _$inUTC_ **boolean**
- _$format_ **string**

Returns: **integer**

-------
#### getCurrentMonth
Get current month.
```php
public static function getCurrentMonth(boolean $inUTC) : integer
```
Arguments:
- _$inUTC_ **boolean**

Returns: **integer**

-------
#### getCurrentHour
Get current hour.
```php
public static function getCurrentHour(boolean $inUTC) : integer
```
Arguments:
- _$inUTC_ **boolean**

Returns: **integer**

-------
#### getCurrentMinutes
Get current minutes.
```php
public static function getCurrentMinutes(boolean $inUTC) : integer
```
Arguments:
- _$inUTC_ **boolean**

Returns: **integer**

-------
#### format
Format date.
```php
public function format(string $format) : string
```
Arguments:
- _$format_ **string** - Format accepted by date(). When empty it&#039;s using the default format.

Returns: **string**

-------
#### __toString
Returns date as string using formatting for the class.
```php
public function __toString() : string
```

Returns: **string**

-------
#### jsonSerialize
Returns data which should be serialized to JSON.
```php
public function jsonSerialize() : string
```

Returns: **string**

-------
#### targetSerialize
Serialize object for given target.
```php
public function targetSerialize(string $target, mixed $params) : stdClass|string|array|NULL
```
Arguments:
- _$target_ **string** - The serialization target (one of the TSer constants), 
- _$params_ **mixed** - The additional parameters that serializer might need

Throws:
- Exception

Returns: **stdClass|string|array|NULL**

-------
