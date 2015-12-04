## Interface Kicaj\Tools\Db\DbConnector
Database connection interface.

## Extends

- Kicaj\Tools\Itf\Error

## Constants

```php
const DB_DRIVER_MYSQL = 'mysql';
const DB_CFG_HOST = 'host';
const DB_CFG_USERNAME = 'username';
const DB_CFG_PASSWORD = 'password';
const DB_CFG_DATABASE = 'database';
const DB_CFG_PORT = 'port';
const DB_CFG_DEBUG = 'debug';
const DB_CFG_DRIVER = 'driver';
```

## Methods

|                          |                          |                          |
| ------------------------ | ------------------------ | ------------------------ |
|   [dbSetup](#dbsetup)    | [dbConnect](#dbconnect)  |   [dbClose](#dbclose)    |

-------
## Methods
#### dbSetup
Configure database.
```php
public function dbSetup(array $dbConfig) : \Kicaj\Tools\Db\DbConnector
```
Arguments:
- _$dbConfig_ **array** - The database configuration. See self::DB_CFG_* constants.

Returns: **\Kicaj\Tools\Db\DbConnector**

-------
#### dbConnect
Connect to database.

This method might be called multiple times but only the first call should connect to database.
```php
public function dbConnect() : boolean
```

Returns: **boolean** - Returns true on success.

-------
#### dbClose
Close database connection.
```php
public function dbClose() : boolean
```

Returns: **boolean**

-------
