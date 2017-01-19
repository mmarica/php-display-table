## Padding

The default values for padding are:
+ horizontal: 1
+ vertical: 0

The padding can be easily customized:

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

Or maybe you would prefer no padding at all:

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
    ->noPadding()
    ->generate();
```

```
.-.-------------.--------------------------------.
|#|   Person    |            Hobbies             |
:-+-------------+--------------------------------:
|1|Mihai        |Cycling, Gaming, Programming    |
|2|Chewbacca    |Growling, hibernating           |
|3|Philip J. Fry|Time traveling, eating anchovies|
'-'-------------'--------------------------------'
```
