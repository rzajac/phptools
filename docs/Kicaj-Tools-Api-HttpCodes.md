## Class Kicaj\Tools\Api\HttpCodes
Helper for HTTP response codes.

## Constants

```php
const HTTP_CONTINUE = 100;
const HTTP_SWITCHING_PROTOCOLS = 101;
const HTTP_OK = 200;
const HTTP_CREATED = 201;
const HTTP_ACCEPTED = 202;
const HTTP_NONAUTHORITATIVE_INFORMATION = 203;
const HTTP_NO_CONTENT = 204;
const HTTP_RESET_CONTENT = 205;
const HTTP_PARTIAL_CONTENT = 206;
const HTTP_MULTIPLE_CHOICES = 300;
const HTTP_MOVED_PERMANENTLY = 301;
const HTTP_FOUND = 302;
const HTTP_SEE_OTHER = 303;
const HTTP_NOT_MODIFIED = 304;
const HTTP_USE_PROXY = 305;
const HTTP_UNUSED = 306;
const HTTP_TEMPORARY_REDIRECT = 307;
const HTTP_BAD_REQUEST = 400;
const HTTP_UNAUTHORIZED = 401;
const HTTP_PAYMENT_REQUIRED = 402;
const HTTP_FORBIDDEN = 403;
const HTTP_NOT_FOUND = 404;
const HTTP_METHOD_NOT_ALLOWED = 405;
const HTTP_NOT_ACCEPTABLE = 406;
const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
const HTTP_REQUEST_TIMEOUT = 408;
const HTTP_CONFLICT = 409;
const HTTP_GONE = 410;
const HTTP_LENGTH_REQUIRED = 411;
const HTTP_PRECONDITION_FAILED = 412;
const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
const HTTP_REQUEST_URI_TOO_LONG = 414;
const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
const HTTP_EXPECTATION_FAILED = 417;
const HTTP_INTERNAL_SERVER_ERROR = 500;
const HTTP_NOT_IMPLEMENTED = 501;
const HTTP_BAD_GATEWAY = 502;
const HTTP_SERVICE_UNAVAILABLE = 503;
const HTTP_GATEWAY_TIMEOUT = 504;
const HTTP_VERSION_NOT_SUPPORTED = 505;
```

## Methods

|                                      |                                      |                                      |                                      |
| ------------------------------------ | ------------------------------------ | ------------------------------------ | ------------------------------------ |
   [httpHeaderFor](#httpheaderfor)    |[getMessageForCode](#getmessageforcode)|         [isError](#iserror)          |            [isOk](#isok)             |
     [mayHaveBody](#mayhavebody)      |                [](#)                 |                [](#)                 |                [](#)                 |

## Properties

|                      |
| -------------------- |
[$messages](#messages)|

-------

-------
## Methods
#### httpHeaderFor
Returns HTTP response header for given HTTP response code.
```php
public static function httpHeaderFor(integer $code) : string
```
Arguments:
- _$code_ **integer**

Returns: **string**

-------
#### getMessageForCode
Returns HTTP response message for given HTTP response code.
```php
public static function getMessageForCode(integer $code) : string
```
Arguments:
- _$code_ **integer**

Returns: **string**

-------
#### isError
Returns true if HTTP response code is considered an error.
```php
public static function isError(integer $code) : boolean
```
Arguments:
- _$code_ **integer** - The HTTP response code

Returns: **boolean**

-------
#### isOk
Returns true if HTTP response code is considered not an error.
```php
public static function isOk(integer $code) : boolean
```
Arguments:
- _$code_ **integer** - The HTTP response code

Returns: **boolean**

-------
#### mayHaveBody
Returns true for HTTP response codes that may have body.
```php
public static function mayHaveBody(integer $code) : boolean
```
Arguments:
- _$code_ **integer** - The HTTP response code

Returns: **boolean**

-------
