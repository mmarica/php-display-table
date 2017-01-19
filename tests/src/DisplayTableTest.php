<?php
namespace Tests;


use Mmarica\DisplayTable;
use Mmarica\DisplayTable\Output\TextOutput;


class DisplayTableTest extends AbstractTest
{
    public function test_Create()
    {
        $this->assertInstanceOf(DisplayTable::class, DisplayTable::create());
    }

    public function test_FromCsv()
    {
        DisplayTable::fromCsv($this->_getResourceFilename(__METHOD__, '.csv'));
    }

    public function test_ToText()
    {
        $this->assertInstanceOf(TextOutput::class, DisplayTable::create()->toText());
    }

    public function test_HeaderRows()
    {
        DisplayTable::create()->headerRow([]);
        DisplayTable::create()->headerRows([[]]);
    }

    public function test_DataRows()
    {
        DisplayTable::create()->dataRow([]);
        DisplayTable::create()->dataRows([[]]);
    }
}