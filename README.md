# jsobj2php
[![Packagist](https://img.shields.io/packagist/v/osushi/jsobj2php.svg)](https://packagist.org/packages/osushi/jsobj2php)


Functions
---
+ Convert into php array from javascript object

Requirements
---
- PHP >= 7.0.*

Usage
---

```
composer require osushi/jsobj2php
```

Examples
---

See: https://github.com/Osushi/jsobj2php/blob/master/example.php

```php
<?php
require_once 'vendor/autoload.php';

use JsObj2Php\Converter;

$str = '{
baseprice:3300,
items:[{id:1,price:1000,commnet:"foo",memo:[]},{id:2,price:2000,memo:[]}],
counts:[10, 20],
message:"ほげ",
pickup:{id:1,price:1000,commnet:"foo",memo:[0, 1, 2]}
}';

var_export(Converter::execute($str, true)); // If here sets `Converter::execute($str)`, you can get stdClass object.
/*
array (
  'baseprice' => 3300,
  'items' =>
  array (
    0 =>
    array (
      'id' => 1,
      'price' => 1000,
      'commnet' => 'foo',
      'memo' =>
      array (
      ),
    ),
    1 =>
    array (
      'id' => 2,
      'price' => 2000,
      'memo' =>
      array (
      ),
    ),
  ),
  'counts' =>
  array (
    0 => 10,
    1 => 20,
  ),
  'message' => 'ほげ',
  'pickup' =>
  array (
    'id' => 1,
    'price' => 1000,
    'commnet' => 'foo',
    'memo' =>
    array (
      0 => 0,
      1 => 1,
      2 => 2,
    ),
  ),
)
*/
```
