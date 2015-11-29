## Abstract class Kicaj\Tools\Date\DateCalc
Class for handling date and time related calculations.

## Methods

|                                                      |                                                      |                                                      |
| ---------------------------------------------------- | ---------------------------------------------------- | ---------------------------------------------------- |
|              [durationHI](#durationhi)               |    [secondsSinceMidnight](#secondssincemidnight)     | [secondsSinceMidnightStr](#secondssincemidnightstr)  |
|           [formatStrTime](#formatstrtime)            |                        [](#)                         |                        [](#)                         |

-------
## Methods
#### durationHI
Get duration in minutes formatted as ex.: 2h 10min.
```php
public static function durationHI(integer $duration) : string
```
Arguments:
- _$duration_ **integer** - The duration in minutes

Returns: **string**

-------
#### secondsSinceMidnight
Return number of seconds since midnight.
```php
public static function secondsSinceMidnight(integer $hour, integer $minute, integer $second) : integer
```
Arguments:
- _$hour_ **integer** - The hour 0 - 23, 
- _$minute_ **integer** - The minute 0 - 59, 
- _$second_ **integer** - The second 0 - 59

Returns: **integer**

-------
#### secondsSinceMidnightStr
Return number of seconds since midnight.
```php
public static function secondsSinceMidnightStr(string $time) : integer|null
```
Arguments:
- _$time_ **string** - The time in format: HH:MM:SS or HH:MM

Returns: **integer|null** - Returns null on error

-------
#### formatStrTime
Takes time in hhmmss format and returns formatted string.
```php
public static function formatStrTime(integer|string $time, boolean $withSeconds) : string
```
Arguments:
- _$time_ **integer|string** - The time in hhmmss or hhmm format, 
- _$withSeconds_ **boolean** - Set to true to add seconds if not provided

Returns: **string** - The formatted string hh:mm:ss or hh:mm

-------
