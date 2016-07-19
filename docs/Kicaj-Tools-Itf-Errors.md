## Interface Kicaj\Tools\Itf\Errors
Errors interface.

## Extends

- Kicaj\Tools\Itf\Error

## Methods

|                          |                          |                          |
| ------------------------ | ------------------------ | ------------------------ |
| [setErrors](#seterrors)  | [hasErrors](#haserrors)  | [getErrors](#geterrors)  |

-------
## Methods
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
#### getErrors
Returns array of errors.
```php
public function getErrors() : \Exception[]
```

Returns: **\Exception[]**

-------
