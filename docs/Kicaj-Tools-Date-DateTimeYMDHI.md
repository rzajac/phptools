## Class Kicaj\Tools\Date\DateTimeYMDHI
Specialized DateTime subclass with default format set to Y-m-d H:i.

## Extends

- Kicaj\Tools\Date\DateTime

## Uses traits

- [Kicaj\Tools\Traits\Hollow](Kicaj-Tools-Traits-Hollow.md)

## Constants

```php
const FORMAT = 'Y-m-d H:i';
const YEAR_FORMAT_LONG = 'Y';
const YEAR_FORMAT_SHORT = 'y';
const TIME_FORMAT_LONG = 'H:i:s';
const TIME_FORMAT_SHORT = 'H:i';
```

## Properties

|                              |                              |                              |
| ---------------------------- | ---------------------------- | ---------------------------- |
|      [$format](#format)      |  [$formatBack](#formatback)  |   [$_isHollow](#_ishollow)   |

-------

#### $format
Default serialization format.

```php
protected string $format = 'Y-m-d H:i:s'
```

#### $formatBack
Backup of default serialization format.

```php
protected string $formatBack
```

-------
## Methods
