<?php
namespace Tests\DisplayTable\Input;

use Mmarica\DisplayTable\Input\CsvFileInput;
use Tests\AbstractTest;


class CsvFileInputTest extends AbstractTest
{
    public function test_FileNotFound()
    {
        $this->setExpectedException(\Exception::class);
        @new CsvFileInput('missing_file.csv');
    }

    public function test_Default()
    {
        $input = new CsvFileInput($this->_getResourceFilename(__METHOD__, '.csv'));

        $this->assertSame([['#', 'Why', 'Hello!']], $input->getHeaderRows());

        $this->assertSame([
            ['This', 'table', 'was'],
            ['loaded', 'from', 'csv'],
        ], $input->getDataRows());
    }

    public function test_HeaderLines()
    {
        $input = new CsvFileInput($this->_getResourceFilename(__METHOD__, '.csv'), 2);

        $this->assertSame([
            ['#', 'Why', 'Hello!'],
            ['Second', 'Header', 'Line'],
        ], $input->getHeaderRows());

        $this->assertSame([
            ['This', 'table', 'was'],
            ['loaded', 'from', 'csv'],
        ], $input->getDataRows());
    }

    public function test_CsvOptions()
    {
        $input = new CsvFileInput($this->_getResourceFilename(__METHOD__, '.csv'), 1, [
            CsvFileInput::CSV_LENGTH => 4096,
            CsvFileInput::CSV_DELIMITER => ';',
            CsvFileInput::CSV_ENCLOSURE => '\'',
            CsvFileInput::CSV_ESCAPE => '\\',
        ]);

        $this->assertSame([['#', 'Why', 'Hello!']], $input->getHeaderRows());

        $this->assertSame([
            ['I', 'can', 'use'],
            ['the', 'comma (,)', 'now'],
        ], $input->getDataRows());
    }
}
