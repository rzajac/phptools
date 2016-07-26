## Abstract class Kicaj\Tools\Helper\Err
Error handling.

## Methods

|                                                    |                                                    |                                                    |
| -------------------------------------------------- | -------------------------------------------------- | -------------------------------------------------- |
|         [errToException](#errtoexception)          |         [restoreHandler](#restorehandler)          | [getCurrentErrorHandler](#getcurrenterrorhandler)  |

-------
## Methods
#### errToException
Change errors to exceptions.
```php
public static function errToException(boolean $turnOn) : mixed
```
Arguments:
- _$turnOn_ **boolean** - Set to false to turn off user defined error exception handling and set the default one.

Returns: **mixed**

-------
#### restoreHandler
Restore error handler.
```php
public static function restoreHandler(mixed $handler) : mixed
```
Arguments:
- _$handler_ **mixed**

Returns: **mixed**

-------
#### getCurrentErrorHandler
Return current error handler.
```php
public static function getCurrentErrorHandler() : mixed
```

Returns: **mixed**

-------
