## Abstract class Kicaj\Tools\Helper\Arr
Helper class operating on arrays.

## Methods

|                        |                        |                        |                        |                        |                        |                        |
| ---------------------- | ---------------------- | ---------------------- | ---------------------- | ---------------------- | ---------------------- | ---------------------- |
|    [every](#every)     | [toObject](#toobject)  |   [fillUp](#fillup)    |    [range](#range)     |      [get](#get)       |    [fetch](#fetch)     |   [remove](#remove)    |
|     [keep](#keep)      |         [](#)          |         [](#)          |         [](#)          |         [](#)          |         [](#)          |         [](#)          |

-------
## Methods
#### every
Returns TRUE if all values in the passed array are equal to $value.
```php
public static function every(array $arr, mixed $value, boolean $strict) : boolean
```
Arguments:
- _$arr_ **array** - The array, 
- _$value_ **mixed** - The value to check for, 
- _$strict_ **boolean** - If TRUE the strict mode is used

Returns: **boolean**

-------
#### toObject
Translates associative array to stdClass.
```php
public static function toObject(array $arr) : stdClass
```
Arguments:
- _$arr_ **array**

Returns: **stdClass**

-------
#### fillUp
Fill array to $minCount elements with given value.
```php
public static function fillUp(array $arr, integer $minCount, mixed $value) : array
```
Arguments:
- _$arr_ **array** - The array to fill up, 
- _$minCount_ **integer** - The minimum number of elements, 
- _$value_ **mixed** - The value to fill array with

Returns: **array**

-------
#### range
Fill an array with a range of numbers.
```php
public static function range(integer $max, integer $start, integer $step) : array
```
Arguments:
- _$max_ **integer** - The maximum ending number, 
- _$start_ **integer** - The start number, 
- _$step_ **integer** - The stepping

Returns: **array**

-------
#### get
Return array key value or default if it does not exist.
```php
public static function get(array $array, string $key, mixed $default) : mixed
```
Arguments:
- _$array_ **array** - The array, 
- _$key_ **string** - The key to get value for, 
- _$default_ **mixed** - The default value to return if key doesn&#039;t exist

Returns: **mixed**

-------
#### fetch
Fetch nested array value by dot notation path.

Arr::fetch(&#039;key1.key2&#039;, $arr);
```php
public static function fetch(array $array, string|array $path, mixed $default) : mixed
```
Arguments:
- _$array_ **array** - The array to get value from., 
- _$path_ **string|array** - The key in dot notation. You can also pass array with keys., 
- _$default_ **mixed** - The default value if key does not exist.

Returns: **mixed**

-------
#### remove
Remove keys listed in $keysToRemove array.
```php
public static function remove(array $array, array|string $keysToRemove) : array
```
Arguments:
- _$array_ **array** - The array to remove keys from, 
- _$keysToRemove_ **array|string** - The key or keys to remove

Returns: **array**

-------
#### keep
Keep only the keys listed in $keysToKeep array.
```php
public static function keep(array $array, array|string $keysToKeep) : array
```
Arguments:
- _$array_ **array** - The array to remove keys from, 
- _$keysToKeep_ **array|string** - The keys to keep

Returns: **array**

-------
