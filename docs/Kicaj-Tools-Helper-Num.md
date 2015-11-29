## Class Kicaj\Tools\Helper\Num
Helper class with number related methods.

## Methods

|                              |                              |                              |
| ---------------------------- | ---------------------------- | ---------------------------- |
| [equalWithin](#equalwithin)  |       [isOdd](#isodd)        |      [isEven](#iseven)       |

-------
## Methods
#### equalWithin
Are two numbers equal within given delta.
```php
public static function equalWithin(integer|float $a, integer|float $b, integer|float $delta) : boolean
```
Arguments:
- _$a_ **integer|float**
- _$b_ **integer|float**
- _$delta_ **integer|float**

Returns: **boolean**

-------
#### isOdd
Return true if num is odd.
```php
public static function isOdd(integer $num) : boolean
```
Arguments:
- _$num_ **integer**

Returns: **boolean**

-------
#### isEven
Return true if num is even.
```php
public static function isEven(integer $num) : boolean
```
Arguments:
- _$num_ **integer**

Returns: **boolean**

-------
