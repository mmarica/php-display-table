## Border styles

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

print DisplayTable::create()
    ->headerRow(array('#', 'Person', 'Hobbies'))
    ->dataRows(
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
