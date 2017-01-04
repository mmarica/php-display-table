<?php
require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Mmarica\DisplayTable\Table;
use Mmarica\DisplayTable\AsciiTable;

$data = new Table\Data(
    array('1', '2', '3'),
    array(
        array('a', 'b', 'c'),
        array('d', 'e', 'f'),
    )
);

$asciiTable = new AsciiTable();
print $asciiTable->generate($data);

