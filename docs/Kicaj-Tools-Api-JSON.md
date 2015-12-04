## Class Kicaj\Tools\Api\JSON
JSON helpers.

## Methods

|                    |
| ------------------ |
| [decode](#decode)  |

-------
## Methods
#### decode
Decode JSON string.
```php
public static function decode(string $json, boolean|false $asClass, integer $depth, integer $options) : mixed
```
Arguments:
- _$json_ **string** - The JOSN string being decoded, 
- _$asClass_ **boolean|false** - Set to true to get stdClass, 
- _$depth_ **integer** - The user specified recursion depth, 
- _$options_ **integer** - The bitmask of JSON decode options

Throws:
- \Kicaj\Tools\Api\JSONParseException

Returns: **mixed**

-------
