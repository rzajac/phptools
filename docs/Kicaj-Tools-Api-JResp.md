## Class Kicaj\Tools\Api\JResp
Provides static methods for constructing JSON responses.

## Methods

|                                  |                                  |                                  |                                  |                                  |
| -------------------------------- | -------------------------------- | -------------------------------- | -------------------------------- | -------------------------------- |
|      [retError](#reterror)       | [buildResponse](#buildresponse)  |       [retJSON](#retjson)        |    [retSuccess](#retsuccess)     |     [isSuccess](#issuccess)      |

-------
## Methods
#### retError
Return error.
```php
public static function retError(mixed $value, integer $http_code, boolean $prettyPrint) : string
```
Arguments:
- _$value_ **mixed** - The error response, 
- _$http_code_ **integer** - The HTTP response code, 
- _$prettyPrint_ **boolean** - If true the JSON will be pretty printed

Returns: **string** - JSON encoded $value.

-------
#### buildResponse
Builds API response.
```php
public static function buildResponse(mixed $value, boolean $success, integer $httpCode, \Kicaj\Tools\Itf\Paginer $pagingInfo) : \stdClass
```
Arguments:
- _$value_ **mixed** - The response, 
- _$success_ **boolean** - Set to true for success, false for failure, 
- _$httpCode_ **integer** - The HTTP response code, 
- _$pagingInfo_ **\Kicaj\Tools\Itf\Paginer** - The pagination information coming from Paginer interface

Returns: **\stdClass**

-------
#### retJSON
Return $data encoded as JSON.
```php
public static function retJSON(mixed $response, boolean $prettyPrint) : string
```
Arguments:
- _$response_ **mixed** - The response, 
- _$prettyPrint_ **boolean** - If true the JSON will be pretty printed

Returns: **string** - JSON encoded $response

-------
#### retSuccess
Return success.
```php
public static function retSuccess(mixed $value, integer $http_code, \Kicaj\Tools\Itf\Paginer $pagingInfo, boolean $prettyPrint) : string
```
Arguments:
- _$value_ **mixed** - The success response, 
- _$http_code_ **integer** - The HTTP response code, 
- _$pagingInfo_ **\Kicaj\Tools\Itf\Paginer** - The pagination information coming from Paginer interface, 
- _$prettyPrint_ **boolean** - If true the JSON will be pretty printed

Returns: **string** - JSON encoded $value

-------
#### isSuccess
Check if a response is a success.
```php
public static function isSuccess(\stdClass $response) : boolean
```
Arguments:
- _$response_ **\stdClass** - The AJAX response in a format returned by buildResponse method

Returns: **boolean**

-------
