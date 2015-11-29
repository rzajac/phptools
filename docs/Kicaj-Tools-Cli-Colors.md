## Class Kicaj\Tools\Cli\Colors
CLI colors helper class.

## Methods

|                                                      |                                                      |                                                      |
| ---------------------------------------------------- | ---------------------------------------------------- | ---------------------------------------------------- |
|        [getColoredString](#getcoloredstring)         | [getForegroundColorNames](#getforegroundcolornames)  | [getBackgroundColorNames](#getbackgroundcolornames)  |

## Properties

|                                            |                                            |
| ------------------------------------------ | ------------------------------------------ |
|  [$foreground_colors](#foreground_colors)  |  [$background_colors](#background_colors)  |

-------

-------
## Methods
#### getColoredString
Returns colored string.
```php
public static function getColoredString(string $string, string $foreground_color, string $background_color) : string
```
Arguments:
- _$string_ **string** - The string to applu color to, 
- _$foreground_color_ **string** - The foreground color, 
- _$background_color_ **string** - The background color

Returns: **string**

-------
#### getForegroundColorNames
Returns all foreground color names.
```php
public static function getForegroundColorNames() : string[]
```

Returns: **string[]**

-------
#### getBackgroundColorNames
Returns all background color names.
```php
public static function getBackgroundColorNames() : string[]
```

Returns: **string[]**

-------
