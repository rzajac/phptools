## Interface Kicaj\Tools\Itf\Error
Error interface.

## Methods

|                          |                          |                          |                          |                          |                          |                          |
| ------------------------ | ------------------------ | ------------------------ | ------------------------ | ------------------------ | ------------------------ | ------------------------ |
  [addError](#adderror)   | [setErrors](#seterrors)  | [hasErrors](#haserrors)  |  [hasError](#haserror)   |[resetErrors](#reseterrors)|  [getError](#geterror)   | [getErrors](#geterrors)  |

-------
## Methods
#### addError
Add error.

If the key is not provided the method will just
add another element to the array.
```php
public function addError(\Exception|string $error, string $key) : boolean
```
Arguments:
- _$error_ **\Exception|string** - The error, 
- _$key_ **string** - The associative array key

Throws:
- \Exception

Returns: **boolean** - Always returns false

-------
#### setErrors
Set the errors.
```php
public function setErrors(\Exception[] $errors) : boolean
```
Arguments:
- _$errors_ **\Exception[]**

Returns: **boolean** - Always returns false

-------
#### hasErrors
Returns true if there are any errors.
```php
public function hasErrors() : boolean
```

Returns: **boolean**

-------
#### hasError
Returns true if there are any errors.
```php
public function hasError() : boolean
```

Returns: **boolean**

-------
#### resetErrors
Reset errors.
```php
public function resetErrors() : \Kicaj\Tools\Itf\Error
```

Returns: **\Kicaj\Tools\Itf\Error**

-------
#### getError
Returns first reported error.
```php
public function getError() : \Exception|null
```

Returns: **\Exception|null**

-------
#### getErrors
Returns array of errors.
```php
public function getErrors() : \Exception[]
```

Returns: **\Exception[]**

-------
