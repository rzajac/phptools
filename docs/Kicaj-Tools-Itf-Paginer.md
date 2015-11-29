## Interface Kicaj\Tools\Itf\Paginer
Pagination interface.

## Methods

|                              |                              |                              |
| ---------------------------- | ---------------------------- | ---------------------------- |
[getPageNumber](#getpagenumber)| [getPageSize](#getpagesize)  |[getPageCount](#getpagecount) |

-------
## Methods
#### getPageNumber
Get current page number.

For first page this method should return 1 not 0
```php
public function getPageNumber() : integer
```

Returns: **integer**

-------
#### getPageSize
Get number of data elements in the response.
```php
public function getPageSize() : integer
```

Returns: **integer**

-------
#### getPageCount
Get total number of pages in the result set.

If the result set size is not known this method should return -1.
```php
public function getPageCount() : integer
```

Returns: **integer**

-------
