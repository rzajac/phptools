## Abstract class Kicaj\Tools\Helper\Str
Collection of static helper methods for string and mixed types.

## Methods

|                                                        |                                                        |                                                        |
| ------------------------------------------------------ | ------------------------------------------------------ | ------------------------------------------------------ |
|             [randomString](#randomstring)              |            [generateToken](#generatetoken)             |             [emptyOnFalse](#emptyonfalse)              |
| [getRandomWeightedElement](#getrandomweightedelement)  |                  [slugify](#slugify)                   |               [startsWith](#startswith)                |
|                 [endsWith](#endswith)                  |    [camelCaseToUnderscore](#camelcasetounderscore)     |    [underscoreToCamelCase](#underscoretocamelcase)     |
|                  [oneLine](#oneline)                   |                 [toString](#tostring)                  |                         [](#)                          |

-------
## Methods
#### randomString
Generate random string.
```php
public static function randomString(integer $length) : string
```
Arguments:
- _$length_ **integer** - The length of the string

Returns: **string**

-------
#### generateToken
Generates a random token, uses base64: 0-9a-zA-Z/+.
```php
public static function generateToken(integer $length, boolean $strong) : string
```
Arguments:
- _$length_ **integer** - The token length, 
- _$strong_ **boolean**

Returns: **string** - token

-------
#### emptyOnFalse
If value evaluates to FALSE this method returns empty string.
```php
public static function emptyOnFalse(mixed $value) : string
```
Arguments:
- _$value_ **mixed**

Returns: **string**

-------
#### getRandomWeightedElement
Get random weighted element.

Utility function for getting random values with weighting.

Pass in an associative array, such as array(&#039;A&#039;=&gt;5, &#039;B&#039;=&gt;45, &#039;C&#039;=&gt;50)
An array like this means that &quot;A&quot; has a 5% chance of being selected, &quot;B&quot; 45%, and &quot;C&quot; 50%.
The return value is the array key, A, B, or C in this case.  Note that the values assigned
do not have to be percentages.  The values are simply relative to each other.  If one value
weight was 2, and the other weight of 1, the value with the weight of 2 has about a 66%
chance of being selected.  Also note that weights should be integers.
```php
public static function getRandomWeightedElement(array $weightedValues, integer $default) : integer
```
Arguments:
- _$weightedValues_ **array**
- _$default_ **integer**

Returns: **integer**

-------
#### slugify
Slugify strings.
```php
public static function slugify(string $text) : string
```
Arguments:
- _$text_ **string**

Returns: **string**

-------
#### startsWith
Return TRUE if haystack starts with the needle.
```php
public static function startsWith(string $haystack, string $needle) : boolean
```
Arguments:
- _$haystack_ **string**
- _$needle_ **string**

Returns: **boolean**

-------
#### endsWith
Return TRUE if haystack ends with the needle.
```php
public static function endsWith(string $haystack, string $needle) : boolean
```
Arguments:
- _$haystack_ **string**
- _$needle_ **string**

Returns: **boolean**

-------
#### camelCaseToUnderscore
Change camelCase string to camel_case.
```php
public static function camelCaseToUnderscore(string $input) : string
```
Arguments:
- _$input_ **string**

Returns: **string**

-------
#### underscoreToCamelCase
Change camel_case string to camelCase.
```php
public static function underscoreToCamelCase(string $input) : string
```
Arguments:
- _$input_ **string**

Returns: **string**

-------
#### oneLine
Make multi line string one line.

NOTE: It also replaces multiple whitespace with one
```php
public static function oneLine(string $str) : string
```
Arguments:
- _$str_ **string**

Returns: **string**

-------
#### toString
Cast anything to string.
```php
public static function toString(mixed $value) : string
```
Arguments:
- _$value_ **mixed** - The value to cast to string

Returns: **string**

-------
