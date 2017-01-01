<?php
require "Table.php";

use Mmarica\DisplayTable\Table;
use Mmarica\DisplayTable\Template;

$table = new Table(
    array('1', '2', '3'),
    array(
        array('a', 'b', 'c'),
        array('d', 'e', 'f'),
    )
);

print $table->generate(new Template\Ascii());