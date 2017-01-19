# Border styles

Multiple border styles are available:
+ [Bubble](#bubble)
+ [Compact](#compact)
+ [Differentiated](#differentiated)
+ [Dotted](#dotted)
+ [Girder](#girder)
+ [Github](#github)
+ [Mysql](#mysql)
+ [No Border](#no-border)
+ [Rounded](#rounded) (default)

## Bubble
 
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
    ->bubbleBorder()
    ->generate();
```

```
 o8===(_)===============(_)==================================8o 
(_) # (_)    Person     (_)             Hobbies              (_)
(88===(_)===============(_)==================================88)
(_) 1 (_) Mihai         (_) Cycling, Gaming, Programming     (_)
(88---(_)---------------(_)----------------------------------88)
(_) 2 (_) Chewbacca     (_) Growling, hibernating            (_)
(88---(_)---------------(_)----------------------------------88)
(_) 3 (_) Philip J. Fry (_) Time traveling, eating anchovies (_)
 o8---(_)---------------(_)----------------------------------8o 
```

## Compact

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
    ->compactBorder()
    ->generate();
```

```
 #     Person                  Hobbies              
----------------------------------------------------
 1  Mihai          Cycling, Gaming, Programming     
 2  Chewbacca      Growling, hibernating            
 3  Philip J. Fry  Time traveling, eating anchovies 
```

## Differentiated

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

## Dotted

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
    ->dottedBorder()
    ->generate();
```

```
........................................................
: # :    Person     :             Hobbies              :
:...:...............:..................................:
: 1 : Mihai         : Cycling, Gaming, Programming     :
: 2 : Chewbacca     : Growling, hibernating            :
: 3 : Philip J. Fry : Time traveling, eating anchovies :
:...:...............:..................................:
```

## Girder

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
    ->girderBorder()
    ->generate();
```

```
//===[]===============[]==================================\\
|| # ||    Person     ||             Hobbies              ||
|]===[]===============[]==================================[|
|| 1 || Mihai         || Cycling, Gaming, Programming     ||
|]===[]===============[]==================================[|
|| 2 || Chewbacca     || Growling, hibernating            ||
|]===[]===============[]==================================[|
|| 3 || Philip J. Fry || Time traveling, eating anchovies ||
\\---[]---------------[]----------------------------------//
```

## Github

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
    ->githubBorder()
    ->generate();
```

```
| # |    Person     |             Hobbies              |
|---|---------------|----------------------------------|
| 1 | Mihai         | Cycling, Gaming, Programming     |
| 2 | Chewbacca     | Growling, hibernating            |
| 3 | Philip J. Fry | Time traveling, eating anchovies |
```

## Mysql

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

## No Border

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
    ->noBorder()
    ->generate();
```

```
 #     Person                  Hobbies              
 1  Mihai          Cycling, Gaming, Programming     
 2  Chewbacca      Growling, hibernating            
 3  Philip J. Fry  Time traveling, eating anchovies 
```

## Rounded

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
    ->roundedBorder()
    ->generate();
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
