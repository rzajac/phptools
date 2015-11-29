## Interface Kicaj\Tools\Itf\TargetSerializer
Serialization interface.

## Extends

- JsonSerializable

## Constants

```php
const SER_DEFAULT = 'default';
```

## Methods

|                                  |                                  |
| -------------------------------- | -------------------------------- |
[targetSerialize](#targetserialize)| [jsonSerialize](#jsonserialize)  |

-------
## Methods
#### targetSerialize
Serialize object for given target.
```php
public function targetSerialize(string $target, mixed $params) : \stdClass|string|array|NULL
```
Arguments:
- _$target_ **string** - The serialization target (one of the TSer constants), 
- _$params_ **mixed** - The additional parameters that serializer might need

Throws:
- \Exception

Returns: **\stdClass|string|array|NULL**

-------
#### jsonSerialize
Serialize object to JSON.
```php
public function jsonSerialize() : mixed
```

Returns: **mixed**

-------
