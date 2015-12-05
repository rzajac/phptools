## Class Kicaj\Tools\Helper\File
Helper class for operating on files.

## Methods

|                              |                              |                              |                              |                              |
| ---------------------------- | ---------------------------- | ---------------------------- | ---------------------------- | ---------------------------- |
| [__construct](#__construct)  |        [make](#make)         |   [splitFile](#splitfile)    |     [getHash](#gethash)      |     [getSize](#getsize)      |

## Properties

|                          |
| ------------------------ |
|  [$filePath](#filepath)  |

-------

#### $filePath
File path.

```php
protected string $filePath
```

-------
## Methods
#### __construct
Constructor.
```php
public function __construct(string $filePath, string $dirPath) : 
```
Arguments:
- _$filePath_ **string**
- _$dirPath_ **string**

Throws:
- Exception

-------
#### make
Make.
```php
public static function make(string $filePath, string $dirPath) : Kicaj\Tools\Helper\File
```
Arguments:
- _$filePath_ **string**
- _$dirPath_ **string**

Returns: **[Kicaj\Tools\Helper\File](Kicaj-Tools-Helper-File.md)**

-------
#### splitFile
Split file into chunks and save it to destination.
```php
public function splitFile(string $dstDir, integer $chunkSize) : array
```
Arguments:
- _$dstDir_ **string** - The destination folder path, 
- _$chunkSize_ **integer**

Returns: **array** - The array of chunk names

-------
#### getHash
Returns SHA1 hash of the file.
```php
public function getHash() : string
```

Returns: **string**

-------
#### getSize
Return file size in bytes.
```php
public function getSize() : integer
```

Returns: **integer**

-------
