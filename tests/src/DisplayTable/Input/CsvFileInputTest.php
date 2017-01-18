<?php
namespace Tests\DisplayTable\Input;

use Mmarica\DisplayTable\Input\CsvFileInput;
use Tests\AbstractTest;


class CsvFileInputTest extends AbstractTest
{
    public function test_Default()
    {
        $input = new CsvFileInput($this->_getResourceFilename(__METHOD__, '.csv'));

        $this->assertSame(array(
            array('#', 'Why', 'Hello!'),
        ), $input->getHeaderRows());

        $this->assertSame(array(
            array('This', 'table', 'was'),
            array('loaded', 'from', 'csv'),
        ), $input->getDataRows());
    }

    public function test_HeaderLines()
    {
        $input = new CsvFileInput($this->_getResourceFilename(__METHOD__, '.csv'), 2);

        $this->assertSame(array(
            array('#', 'Why', 'Hello!'),
            array('Second', 'Header', 'Line'),
        ), $input->getHeaderRows());

        $this->assertSame(array(
            array('This', 'table', 'was'),
            array('loaded', 'from', 'csv'),
        ), $input->getDataRows());
    }

    public function test_CsvOptions()
    {
        $input = new CsvFileInput($this->_getResourceFilename(__METHOD__, '.csv'), 1,
            array(
                CsvFileInput::CSV_LENGTH => 4096,
                CsvFileInput::CSV_DELIMITER => ';',
                CsvFileInput::CSV_ENCLOSURE => '\'',
                CsvFileInput::CSV_ESCAPE => '\\',
            )
        );

        $this->assertSame(array(
            array('#', 'Why', 'Hello!'),
        ), $input->getHeaderRows());

        $this->assertSame(array(
            array('I', 'can', 'use'),
            array('the', 'comma (,)', 'now'),
        ), $input->getDataRows());
    }
}
