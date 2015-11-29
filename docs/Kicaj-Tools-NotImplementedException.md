## Class Kicaj\Tools\NotImplementedException
NotImplementedException exception.

## Extends

- Kicaj\Tools\Exception

## Constants

```php
const EC_UNKNOWN = 'EC_UNKNOWN';
```

## Methods

|                          |
| ------------------------ |
[__construct](#__construct)|

## Properties

|                        |
| ---------------------- |
[$errorCode](#errorcode)|

-------

#### $errorCode
The error code.

```php
protected string $errorCode = self::EC_UNKNOWN
```

-------
## Methods
#### __construct
NotImplementedException constructor.
```php
public function __construct(string $message, string $ecCode, \Exception|null $previous) : 
```
Arguments:
- _$message_ **string**
- _$ecCode_ **string**
- _$previous_ **\Exception|null**

-------
