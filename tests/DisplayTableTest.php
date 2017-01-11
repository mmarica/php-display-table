<?php
namespace Tests\DisplayTable;


use Mmarica\DisplayTable;
use Mmarica\DisplayTable\Output;
use PHPUnit_Framework_TestCase;


class DisplayTableTest extends PHPUnit_Framework_TestCase
{
    public function test_FromArrays()
    {
        $header = array('#', 'Person', 'Hobbies');
        $rows = array(
            array('1', 'Mihai', 'Cycling, Gaming, Programming'),
            array('2', 'Chewbacca', 'Growling, hibernating'),
            array('3', 'Philip J. Fry', 'Time traveling, eating anchovies'),
        );

        $this->assertInstanceOf(DisplayTable::class, DisplayTable::fromArrays($header, $rows));
    }

    public function test_ToAscii()
    {
        $this->assertInstanceOf(Output\Ascii::class, DisplayTable::fromArrays()->toAscii());
    }
}