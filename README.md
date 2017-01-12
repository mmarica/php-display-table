# Display tables

[![Latest Stable Version](https://img.shields.io/packagist/v/mmarica/display-table.svg?style=flat&label=release)](https://packagist.org/packages/mmarica/display-table)
[![Software License](https://img.shields.io/github/license/mmarica/php-display-table.svg?style=flat)](LICENSE)
[![Build Status](https://img.shields.io/travis/mmarica/php-display-table.svg?style=flat)](https://travis-ci.org/mmarica/php-display-table)
[![codecov.io](https://img.shields.io/codecov/c/github/mmarica/php-display-table.svg?style=flat)](https://codecov.io/github/mmarica/php-display-table?branch=master)

A simple PHP Library for generating tables in text format, useful for writing summaries in log or console.

## Table of Contents

+ [Installation](#installation)
+ [Requirements](#requirements)
+ [Examples](#examples)

## Installation

The easiest way to install is via composer:

```
$ composer require mmarica/display-table
```

## Requirements

The following versions of PHP are supported by this version.

+ PHP 5.6
+ PHP 7.0
+ PHP 7.1

## Examples

### Your first console table

Printing a text table is as simple as this:

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::fromArray(
    array('#', 'Person', 'Hobbies'),
    array(
        array('1', 'Mihai', 'Cycling, Gaming, Programming'),
        array('2', 'Chewbacca', 'Growling, hibernating'),
        array('3', 'Philip J. Fry', 'Time traveling, eating anchovies'),
    )
)
->toText()->generate();
```

```
.---.---------------.----------------------------------.
| # |    Person     |             Hobbies              |
:---+---------------+----------------------------------:
| 1 | Mihai         | Cycling, Gaming, Programming     |
| 2 | Chewbacca     | Growling, hibernating            |
| 3 | Philip J. Fry | Time traveling, eating anchovies |
'---'---------------'----------------------------------'
```

### Changing the border style

Multiple border styles are available:
+ Bubble
+ Compact
+ Differentiated
+ Dotted
+ Girder
+ Github
+ Mysql
+ Rounded (default)
+ No Border

Changing the border style is a method call away:
 
```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::fromArray(
    array('#', 'Person', 'Hobbies'),
    array(
        array('1', 'Mihai', 'Cycling, Gaming, Programming'),
        array('2', 'Chewbacca', 'Growling, hibernating'),
        array('3', 'Philip J. Fry', 'Time traveling, eating anchovies'),
    )
)
->toText()
->mysqlBorder()
->generate();
```

```
+---+---------------+----------------------------------+
| # |    Person     |             Hobbies              |
+---+---------------+----------------------------------+
| 1 | Mihai         | Cycling, Gaming, Programming     |
| 2 | Chewbacca     | Growling, hibernating            |
| 3 | Philip J. Fry | Time traveling, eating anchovies |
+---+---------------+----------------------------------+

```

### Customizing the padding

The horizontal and vertical padding can be easily customized:

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::fromArray(
    array('#', 'Person', 'Hobbies'),
    array(
        array('1', 'Mihai', 'Cycling, Gaming, Programming'),
        array('2', 'Chewbacca', 'Growling, hibernating'),
        array('3', 'Philip J. Fry', 'Time traveling, eating anchovies'),
    )
)
->toText()
->hPadding(2)->vPadding(1)
->generate();
```

```
.-----.-----------------.------------------------------------.
|     |                 |                                    |
|  #  |     Person      |              Hobbies               |
|     |                 |                                    |
:-----+-----------------+------------------------------------:
|     |                 |                                    |
|  1  |  Mihai          |  Cycling, Gaming, Programming      |
|     |                 |                                    |
|     |                 |                                    |
|  2  |  Chewbacca      |  Growling, hibernating             |
|     |                 |                                    |
|     |                 |                                    |
|  3  |  Philip J. Fry  |  Time traveling, eating anchovies  |
|     |                 |                                    |
'-----'-----------------'------------------------------------'
```

### Using the same data to print multiple tables in different styles

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

$table = DisplayTable::fromArray(
    array('#', 'Person', 'Hobbies'),
    array(
        array('1', 'Mihai', 'Cycling, Gaming, Programming'),
        array('2', 'Chewbacca', 'Growling, hibernating'),
        array('3', 'Philip J. Fry', 'Time traveling, eating anchovies'),
    )
);

print $table->toText()->differentiatedBorder()->generate();
print $table->toText()->dottedBorder()->generate();
```

```
+===+===============+==================================+
| # |    Person     |             Hobbies              |
+===+===============+==================================+
| 1 | Mihai         | Cycling, Gaming, Programming     |
+---+---------------+----------------------------------+
| 2 | Chewbacca     | Growling, hibernating            |
+---+---------------+----------------------------------+
| 3 | Philip J. Fry | Time traveling, eating anchovies |
+---+---------------+----------------------------------+
........................................................
: # :    Person     :             Hobbies              :
:...:...............:..................................:
: 1 : Mihai         : Cycling, Gaming, Programming     :
: 2 : Chewbacca     : Growling, hibernating            :
: 3 : Philip J. Fry : Time traveling, eating anchovies :
:...:...............:..................................:
```