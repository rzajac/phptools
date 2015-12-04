## Final class Kicaj\Tools\Tst\Tst
Test helpers.

## Methods

|                                      |                                      |
| ------------------------------------ | ------------------------------------ |
|    [isUnitTested](#isunittested)     | [setAsUnitTested](#setasunittested)  |

-------
## Methods
#### isUnitTested
Returns true when under unit tests.

Good place to put define is in unit test bootstrap file:

define(&#039;UNIT_TEST_YOUR_APPLICATION_TEST_SUITE&#039;, &#039;yes&#039;);
```php
public static function isUnitTested() : boolean
```

Returns: **boolean**

-------
#### setAsUnitTested
Indicate application is being unit tested.
```php
public static function setAsUnitTested() : 
```

-------
