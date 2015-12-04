## Class Kicaj\Tools\Cli\Interaction
CLI user interactions helper.

## Methods

|                                |                                |
| ------------------------------ | ------------------------------ |
|  [getPassword](#getpassword)   | [commandExist](#commandexist)  |

-------
## Methods
#### getPassword
Get password from command line.

Note: you probably should trim the return
```php
public static function getPassword(string $prompt) : string
```
Arguments:
- _$prompt_ **string** - The CLI prompt text

Returns: **string**

-------
#### commandExist
Returns true if shell command exists.
```php
public static function commandExist(string $cmd) : boolean
```
Arguments:
- _$cmd_ **string** - The command line program to check.

Returns: **boolean**

-------
