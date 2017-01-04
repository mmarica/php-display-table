# Display tables

[![Latest Stable Version](https://poser.pugx.org/mmarica/display-table/v/stable)](https://packagist.org/packages/mmarica/display-table)
[![Build Status](https://travis-ci.org/mmarica/php-display-table.svg?branch=master)](https://travis-ci.org/mmarica/php-display-table)
[![PHP-Eye](https://php-eye.com/badge/mmarica/php-display-table/tested.svg?style=flat)](https://php-eye.com/package/mmarica/php-display-table)

A simple PHP Library for generating tables in ASCII format, useful for writing summaries in log or console.

## Installation

The easiest way to install is via composer:

```
$ composer require mmarica/display-table
```

## Examples

Print ASCII table to output:

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable\DataSource;
use Mmarica\DisplayTable\AsciiTable;

$data = new DataSource\FromArray(
    array('#', 'Person', 'Hobbies'),
    array(
        array('1', 'Mihai', 'Cycling, Gaming, Programming'),
        array('2', 'Chewbacca', 'Growling'),
        array('3', 'Tudor', 'Diets'),
    )
);

$asciiTable = new AsciiTable();
print $asciiTable->generate($data);
```