## Header and data

A table can have [one header row](#one-header-row), [multiple header rows](#multiple-header-rows) or even [no header at all](#no-header-rows).

It also can have [one data row](#one-data-row), [multiple data rows](#multiple-data-rows) or [no data rows](#no-data-rows).

### One header row

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
    ->toText()
    ->differentiatedBorder()
    ->generate();
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
```

### Multiple header rows

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::create()
    ->headerRow(['#', 'Person', 'Hobbies'])
    ->headerRow(['-', '(who)', '(what)'])
    ->dataRows([
        ['1', 'Mihai', 'Cycling, Gaming, Programming'],
        ['2', 'Chewbacca', 'Growling, hibernating'],
        ['3', 'Philip J. Fry', 'Time traveling, eating anchovies'],
    ])
    ->toText()
    ->differentiatedBorder()
    ->generate();
```

Or do it like this, same result:

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::create()
    ->headerRows([
        ['#', 'Person', 'Hobbies'],
        ['-', '(who)', '(what)']
    ])
    ->dataRows([
        ['1', 'Mihai', 'Cycling, Gaming, Programming'],
        ['2', 'Chewbacca', 'Growling, hibernating'],
        ['3', 'Philip J. Fry', 'Time traveling, eating anchovies'],
    ])
    ->toText()
    ->differentiatedBorder()
    ->generate();
```

```
+===+===============+==================================+
| # |    Person     |             Hobbies              |
+===+===============+==================================+
| - |     (who)     |              (what)              |
+===+===============+==================================+
| 1 | Mihai         | Cycling, Gaming, Programming     |
+---+---------------+----------------------------------+
| 2 | Chewbacca     | Growling, hibernating            |
+---+---------------+----------------------------------+
| 3 | Philip J. Fry | Time traveling, eating anchovies |
+---+---------------+----------------------------------+
```

## No header rows

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::create()
    ->dataRows([
        ['1', 'Mihai', 'Cycling, Gaming, Programming'],
        ['2', 'Chewbacca', 'Growling, hibernating'],
        ['3', 'Philip J. Fry', 'Time traveling, eating anchovies'],
    ])
    ->toText()
    ->differentiatedBorder()
    ->generate();
```

```
+---+---------------+----------------------------------+
| 1 | Mihai         | Cycling, Gaming, Programming     |
+---+---------------+----------------------------------+
| 2 | Chewbacca     | Growling, hibernating            |
+---+---------------+----------------------------------+
| 3 | Philip J. Fry | Time traveling, eating anchovies |
+---+---------------+----------------------------------+
```

### One data row

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::create()
    ->headerRow(['#', 'Person', 'Hobbies'])
    ->dataRow(['1', 'Mihai', 'Cycling, Gaming, Programming'])
    ->toText()
    ->differentiatedBorder()
    ->generate();
```

```
+===+========+==============================+
| # | Person |           Hobbies            |
+===+========+==============================+
| 1 | Mihai  | Cycling, Gaming, Programming |
+---+--------+------------------------------+
```

### Multiple data rows

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::create()
    ->headerRow(['#', 'Person', 'Hobbies'])
    ->dataRow(['1', 'Mihai', 'Cycling, Gaming, Programming'])
    ->dataRow(['2', 'Chewbacca', 'Growling, hibernating'])
    ->dataRow(['3', 'Philip J. Fry', 'Time traveling, eating anchovies'])
    ->toText()
    ->differentiatedBorder()
    ->generate();
```

Or do it like this, same result:

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
    ->toText()
    ->differentiatedBorder()
    ->generate();
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
```

## No data rows

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::create()
    ->headerRow(['#', 'Person', 'Hobbies'])
    ->toText()
    ->differentiatedBorder()
    ->generate();
```

```
+===+========+=========+
| # | Person | Hobbies |
+===+========+=========+
```
