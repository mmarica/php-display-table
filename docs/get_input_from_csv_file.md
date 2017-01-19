## Get input from CSV file

For this example, create a file named 'table.csv' in the same folder as your script, with this content:

```
#,Why,Hello!
This,table,was
loaded,from,csv
```

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;

print DisplayTable::fromCsv('table.csv')
    ->toText()
    ->generate();
```

```
.--------.-------.--------.
|   #    |  Why  | Hello! |
:--------+-------+--------:
| This   | table | was    |
| loaded | from  | csv    |
'--------'-------'--------'
```

The number of lines from the start at your file that represent the header rows is configurable. Also, various csv format specific options may be configured. Update the content of 'table.csv' like below:   

```
'#';'Why';'Hello!'
'Second';'Header';'Line'
'I';'can';'use'
'the';'comma (,)';'now'
```

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Mmarica\DisplayTable;
use Mmarica\DisplayTable\Input\CsvFileInput;

print DisplayTable::fromCsv(
        'table.csv', // csv file name, doh!
        2,           // number of lines that represent the header
    
        // csv format options start here (for details look here: http://php.net/manual/en/function.fgetcsv.php)
        [
            CsvFileInput::CSV_LENGTH => 4096,
            CsvFileInput::CSV_DELIMITER => ';',
            CsvFileInput::CSV_ENCLOSURE => '\'',
            CsvFileInput::CSV_ESCAPE => '\\',
        ]
    )
    ->toText()
    ->generate();
```

```
.--------.-----------.------.
|   #    |    Why    |Hello!|
:--------+-----------+------:
| Second |  Header   | Line |
:--------+-----------+------:
| I      | can       | use  |
| the    | comma (,) | now  |
'--------'-----------'------'
```
