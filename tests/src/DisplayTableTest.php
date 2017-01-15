<?php
namespace Tests\DisplayTable;


use Tests\AbstractTest;
use Mmarica\DisplayTable;
use Mmarica\DisplayTable\Output\TextOutput;


class DisplayTableTest extends AbstractTest
{
    public function test_Create()
    {
        $this->assertInstanceOf(DisplayTable::class, DisplayTable::create());
    }

    public function test_ToText()
    {
        $this->assertInstanceOf(TextOutput::class, DisplayTable::create()->toText());
    }
}