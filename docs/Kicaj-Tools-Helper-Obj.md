## Abstract class Kicaj\Tools\Helper\Obj
Helper class operating on objects.

## Methods

|              |
| ------------ |
| [get](#get)  |

-------
## Methods
#### get
Get object property value or default if it does not exist.

NOTES:

 - this method does not handle PHP errors. Unless you use user defined
   error handler like in @see Err::errToException()

 - objects implementing __get() magic method must also implement __isset()
```php
public static function get(object $obj, string $propName, mixed $default, boolean $handleException) : mixed
```
Arguments:
- _$obj_ **object** - The object, 
- _$propName_ **string** - The property name, 
- _$default_ **mixed** - The default value to return if property name doesn&#039;t exist, 
- _$handleException_ **boolean** - If set to true method will catch eny exceptions thrown when accessing properties

Throws:
- \Exception

Returns: **mixed**

-------
