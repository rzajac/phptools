## Abstract class Kicaj\Tools\Helper\Obj
Helper class operating on objects.

## Methods

|                    |                    |
| ------------------ | ------------------ |
|    [get](#get)     | [getRfl](#getrfl)  |

-------
## Methods
#### get
Get object property value or default if it does not exist.

This handles only public properties.
```php
public static function get(object $obj, string $propName, mixed $default) : mixed
```
Arguments:
- _$obj_ **object** - The object., 
- _$propName_ **string** - The public property name., 
- _$default_ **mixed** - The default value to return if property name doesn&#039;t exist.

Returns: **mixed**

-------
#### getRfl
Get object property value using reflection.

This method is slower then Obj::get.
```php
public static function getRfl(object $obj, string $propName, mixed $default) : mixed|null
```
Arguments:
- _$obj_ **object** - The object., 
- _$propName_ **string** - The property name., 
- _$default_ **mixed** - The default value to return if property name doesn&#039;t exist.

Returns: **mixed|null**

-------
