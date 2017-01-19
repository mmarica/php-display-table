## Same data, multiple tables

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

$table = DisplayTable::create()
     ->headerRow(['#', 'Person', 'Hobbies'])
     ->dataRows([
         ['1', 'Mihai', 'Cycling, Gaming, Programming'],
         ['2', 'Chewbacca', 'Growling, hibernating'],
         ['3', 'Philip J. Fry', 'Time traveling, eating anchovies'],
     ]);

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