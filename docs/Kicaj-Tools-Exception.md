## Class Kicaj\Tools\Exception
Class Exception.

## Extends

- Exception

## Implements

- JsonSerializable

## Constants

```php
const EC_UNKNOWN = 'EC_UNKNOWN';
```

## Methods

|                                          |                                          |                                          |                                          |
| ---------------------------------------- | ---------------------------------------- | ---------------------------------------- | ---------------------------------------- |
|       [__construct](#__construct)        | [makeFromException](#makefromexception)  |    [getUserMessage](#getusermessage)     |      [getErrorCode](#geterrorcode)       |
|     [jsonSerialize](#jsonserialize)      |                  [](#)                   |                  [](#)                   |                  [](#)                   |

## Properties

|                            |
| -------------------------- |
|  [$errorCode](#errorcode)  |

-------

#### $errorCode
The error code.

```php
protected string $errorCode = self::EC_UNKNOWN
```

-------
## Methods
#### __construct
Constructor.
```php
public function __construct(string $message, string $ecCode, Exception $previous) : 
```
Arguments:
- _$message_ **string** - The human readable message or one of the EC_* strings, 
- _$ecCode_ **string** - The EC_* string, 
- _$previous_ **Exception** - The previous exception

-------
#### makeFromException
Creates ApiException from any other exception.
```php
public static function makeFromException(Exception $e, null $overrideCode) : static
```
Arguments:
- _$e_ **Exception** - The original exception., 
- _$overrideCode_ **null** - The code to override.

Returns: **static**

-------
#### getUserMessage
Get user readable error message.
```php
public function getUserMessage() : string
```

Returns: **string**

-------
#### getErrorCode
Returns error code.
```php
public function getErrorCode() : string
```

Returns: **string**

-------
#### jsonSerialize
Returns data which should be serialized to JSON.
```php
public function jsonSerialize() : stdClass
```

Returns: **stdClass**

-------
