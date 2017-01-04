# Display tables

[![Latest Stable Version](https://poser.pugx.org/mmarica/display-table/v/stable)](https://packagist.org/packages/mmarica/display-table)
[![Build Status](https://travis-ci.org/mmarica/php-display-table.svg?branch=master)](https://travis-ci.org/mmarica/php-display-table)

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

print 'Using defaults:' . PHP_EOL;
$asciiTable = new AsciiTable();
print $asciiTable->generate($data) . PHP_EOL;

print 'With custom padding:' . PHP_EOL;
$asciiTable = new AsciiTable(array(
    AsciiTable::OPT_HORIZONTAL_PADDING => 2,
    AsciiTable::OPT_VERTICAL_PADDING => 1
));
print $asciiTable->generate($data) . PHP_EOL;

print 'MySQL style:' . PHP_EOL;
$asciiTable = new AsciiTable(array(
    AsciiTable::OPT_BORDERS => AsciiTable::MYSQL_BORDERS
));
print $asciiTable->generate($data) . PHP_EOL;

print 'Dots style:' . PHP_EOL;
$asciiTable = new AsciiTable(array(
    AsciiTable::OPT_BORDERS => AsciiTable::DOTS_BORDERS
));
print $asciiTable->generate($data) . PHP_EOL;
```

Resulting output:

```
Using defaults:
.---.-----------.------------------------------.
| # |  Person   |           Hobbies            |
:---+-----------+------------------------------:
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |
'---'-----------'------------------------------'

With custom padding:
.-----.-------------.--------------------------------.
|     |             |                                |
|  #  |   Person    |            Hobbies             |
|     |             |                                |
:-----+-------------+--------------------------------:
|     |             |                                |
|  1  |  Mihai      |  Cycling, Gaming, Programming  |
|     |             |                                |
|     |             |                                |
|  2  |  Chewbacca  |  Growling                      |
|     |             |                                |
|     |             |                                |
|  3  |  Tudor      |  Diets                         |
|     |             |                                |
'-----'-------------'--------------------------------'

MySQL style:
+---+-----------+------------------------------+
| # |  Person   |           Hobbies            |
+---+-----------+------------------------------+
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |
+---+-----------+------------------------------+

Dots style:
................................................
: # :  Person   :           Hobbies            :
:...:...........:..............................:
: 1 : Mihai     : Cycling, Gaming, Programming :
: 2 : Chewbacca : Growling                     :
: 3 : Tudor     : Diets                        :
:...:...........:..............................:
```