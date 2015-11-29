## Final class Kicaj\Tools\Db\DbConnect
Database connection helper class.

## Methods

|                      |                      |
| -------------------- | -------------------- |
  [getCfg](#getcfg)   |[getDriver](#getdriver)|

-------
## Methods
#### getCfg
Get config array.
```php
public static function getCfg(string $driver, string $host, string $username, string $password, string $database, string|integer $port, boolean $debug) : array
```
Arguments:
- _$driver_ **string** - The database driver to use. One of the DbConnector::DB_DRIVER_* constants, 
- _$host_ **string** - The database host address, 
- _$username_ **string** - The username, 
- _$password_ **string** - The password, 
- _$database_ **string** - The database name, 
- _$port_ **string|integer** - The database port, 
- _$debug_ **boolean** - Set to true to enable debugging

Returns: **array**

-------
#### getDriver
Get database driver name.
```php
public static function getDriver(array $config) : string
```
Arguments:
- _$config_ **array**

Returns: **string** - One of the DbConnector::DB_DRIVER_* constants

-------
