# StringBuffer
Manipulate strings object oriented.

## Installation
The preferred method of installation is via Packagist and Composer. Run the following command to install the package and add it as a requirement to your project's composer.json:

```
composer require simlux/string-buffer
```

## Examples
```php
<?php
use Simlux\String\StringBuffer();

$buffer = new StringBuffer('test');
$buffer->append('bar')
    ->prepend('foo');
echo $buffer->toString(); // footestbar

// with factory method
echo StringBuffer::create('test')
    ->append('bar')
    ->prepend('foo'); // footestbar
```
