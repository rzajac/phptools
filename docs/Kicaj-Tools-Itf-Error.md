## Interface Kicaj\Tools\Itf\Error
Error interface.

## Methods

|                            |                            |                            |                            |
| -------------------------- | -------------------------- | -------------------------- | -------------------------- |
|   [addError](#adderror)    |   [hasError](#haserror)    | [resetError](#reseterror)  |   [getError](#geterror)    |

-------
## Methods
#### addError
Add error.

If the key is not provided the method will just
add another element to the array.
```php
public function addError(Exception|string $error, string $key) : boolean
```
Arguments:
- _$error_ **Exception|string** - The error, 
- _$key_ **string** - The associative array key

Throws:
- Exception

Returns: **boolean** - Always returns false

-------
#### hasError
Returns true if there are any errors.
```php
public function hasError() : boolean
```

Returns: **boolean**

-------
#### resetError
Reset error.
```php
public function resetError() : Kicaj\Tools\Itf\Error
```

Returns: **[Kicaj\Tools\Itf\Error](Kicaj-Tools-Itf-Error.md)**

-------
#### getError
Returns first reported error.
```php
public function getError() : Exception|null
```

Returns: **Exception|null**

-------
