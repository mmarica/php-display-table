<?php
namespace Tests\DisplayTable;


use Tests\AbstractTest;
use Mmarica\DisplayTable;
use Mmarica\DisplayTable\Output;


class DisplayTableTest extends AbstractTest
{
    public function test_FromArray()
    {
        $header = array('#', 'Person', 'Hobbies');
        $rows = array(
            array('1', 'Mihai', 'Cycling, Gaming, Programming'),
            array('2', 'Chewbacca', 'Growling, hibernating'),
            array('3', 'Philip J. Fry', 'Time traveling, eating anchovies'),
        );

        $this->assertInstanceOf(DisplayTable::class, DisplayTable::fromArray($header, $rows));
    }

    public function test_WithoutData()
    {
        $this->assertInstanceOf(DisplayTable::class, DisplayTable::withoutData());
    }

    public function test_ToAscii()
    {
        $this->assertInstanceOf(Output\AsciiOutput::class, DisplayTable::fromArray()->toAscii());
    }
}