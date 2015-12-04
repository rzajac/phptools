## Class Kicaj\Tools\Lang\Calendar
Calendar translations.

## Constants

```php
const STYLE_LONG = 'long';
const STYLE_SHORT = 'short';
const STYLE_MEDIUM = 'medium';
const LANG_EN = 'en';
const LANG_PL = 'pl';
```

## Methods

|                                          |                                          |                                          |
| ---------------------------------------- | ---------------------------------------- | ---------------------------------------- |
|            [getDay](#getday)             |          [getMonth](#getmonth)           | [checkLanguageCode](#checklanguagecode)  |

## Properties

|                                      |                                      |
| ------------------------------------ | ------------------------------------ |
|  [$supportedLangs](#supportedlangs)  |            [$i18n](#i18n)            |

-------

#### $supportedLangs
Supported translations.

```php
protected static array $supportedLangs = array('en', 'pl')
```

#### $i18n
Translations.

```php
protected static array $i18n = array('en' => array('day' => array('short' => array('Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'), 'medium' => array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'), 'long' => array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')), 'month' => array('short' => array(null, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'), 'long' => array(null, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'))), 'pl' => array('day' => array('short' => array('Nd', 'Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'So'), 'medium' => array('Nie', 'Pon', 'Wto', 'Śro', 'Czw', 'Pią', 'Sob'), 'long' => array('Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota')), 'month' => array('short' => array(null, 'Sty', 'Lut', 'Mar', 'Kwi', 'Maj', 'Cze', 'Lip', 'Sie', 'Wrz', 'Paź', 'Lis', 'Gru'), 'long' => array(null, 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'))))
```

-------
## Methods
#### getDay
Get translated day of the week.
```php
public static function getDay(integer $day, string $langCode, string $style) : mixed
```
Arguments:
- _$day_ **integer** - The day of the week number 1 - 7, 
- _$langCode_ **string** - The supported language code ex: en, 
- _$style_ **string** - The style to return day name in. One of the self::STYLE_* constants

Throws:
- \Exception

Returns: **mixed**

-------
#### getMonth
Get translated month.
```php
public static function getMonth(integer $month, string $langCode, string $style) : mixed
```
Arguments:
- _$month_ **integer** - The month number 1 - 12, 
- _$langCode_ **string** - The supported language code ex: en, 
- _$style_ **string** - The style to return month name in. One of the self::STYLE_* constants

Throws:
- \Exception

Returns: **mixed**

-------
#### checkLanguageCode
Check if language code is supported.
```php
public static function checkLanguageCode(string $languageCode) : string
```
Arguments:
- _$languageCode_ **string** - The supported language code ex: en

Returns: **string** - The supported language code or en

-------
