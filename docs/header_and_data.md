## Header and data

The tables can have more than one header row:

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::create()
    ->headerRow(array('#', 'Person', 'Hobbies'))
    ->headerRow(array('-', '(who)', '(what)'))
    /*
     * This is a valid alternative:
     * ->headerRows(
     *      array('#', 'Person', 'Hobbies'),
     *      array('-', '(who)', '(what)')
     * )
     */
    ->dataRows(
        array(
            array('1', 'Mihai', 'Cycling, Gaming, Programming'),
            array('2', 'Chewbacca', 'Growling, hibernating'),
            array('3', 'Philip J. Fry', 'Time traveling, eating anchovies'),
        )
    )
->toText()
->generate();
```

```
.---.---------------.----------------------------------.
| # |    Person     |             Hobbies              |
:---+---------------+----------------------------------:
| - |     (who)     |              (what)              |
:---+---------------+----------------------------------:
| 1 | Mihai         | Cycling, Gaming, Programming     |
| 2 | Chewbacca     | Growling, hibernating            |
| 3 | Philip J. Fry | Time traveling, eating anchovies |
'---'---------------'----------------------------------'
```
