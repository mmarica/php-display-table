```
+=========+========+=======+=========+
| Console | Tables | Made  |  Easy   |
+=========+========+=======+=========+
```

# Display tables

[![Latest Stable Version](https://img.shields.io/packagist/v/mmarica/display-table.svg?style=flat&label=release)](https://packagist.org/packages/mmarica/display-table)
[![Software License](https://img.shields.io/github/license/mmarica/php-display-table.svg?style=flat)](LICENSE)
[![Build Status](https://img.shields.io/travis/mmarica/php-display-table.svg?style=flat)](https://travis-ci.org/mmarica/php-display-table)
[![codecov.io](https://img.shields.io/codecov/c/github/mmarica/php-display-table.svg?style=flat)](https://codecov.io/github/mmarica/php-display-table?branch=master)

A simple PHP Library for generating tables in text format, useful for writing summaries in log or console.

## Table of Contents

+ [Installation](#installation)
+ [Requirements](#requirements)
+ [Documentation](#documentation)
+ [Example](#example)

## Installation

The easiest way to install is via composer:

```
$ composer require mmarica/display-table
```

## Requirements

The following versions of PHP are supported:

+ PHP 5.6
+ PHP 7.0
+ PHP 7.1

## Documentation

+ [Border styles](docs/border_styles.md)
+ [Padding](docs/padding.md)
+ [Header and data](docs/header_and_data.md)
+ [Same data, multiple tables](docs/same_data_multiple_tables.md)
+ [Get input from CSV file](docs/get_input_from_csv_file.md)

## Example

Printing a text table is as simple as this:

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::create()
    ->headerRow(['#', 'Person', 'Hobbies'])
    ->dataRows([
        ['1', 'Mihai', 'Cycling, Gaming, Programming'],
        ['2', 'Chewbacca', 'Growling, hibernating'],
        ['3', 'Philip J. Fry', 'Time traveling, eating anchovies'],
    ])
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
