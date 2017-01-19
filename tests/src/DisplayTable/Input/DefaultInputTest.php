<?php
namespace Tests\DisplayTable\Input;

use Tests\AbstractTest;
use Mmarica\DisplayTable\Input\DefaultInput;


class DefaultInputTest extends AbstractTest
{
    /**
     * @var DefaultInput
     */
    protected $_input;

    /**
     * @var array
     */
    protected $_headerRows = ['#', 'Person', 'Hobbies'];

    /**
     * @var array
     */
    protected $_dataRows = [
        ['1', 'Mihai', 'Cycling, Gaming, Programming'],
        ['2', 'Chewbacca', 'Growling, hibernating'],
        ['3', 'Philip J. Fry', 'Time traveling, eating anchovies'],
    ];

    protected function setUp()
    {
        parent::setUp();
        $this->_input = new DefaultInput($this->_headerRows, $this->_dataRows);
    }

    public function test_Get()
    {
        list($columns, $rows) = $this->_input->get();
        $this->assertSame($columns, $this->_headerRows);
        $this->assertSame($rows, $this->_dataRows);
    }

    public function test_GetSetHeaderRows()
    {
        $input = clone $this->_input;

        $rows = [
            ['No.', 'Who', 'Likes']
        ];
        $input->setHeaderRows($rows);

        $this->assertSame($input->getHeaderRows(), $rows);
    }

    public function test_AddHeaderRows()
    {
        $input = clone $this->_input;
        $rows = $this->_headerRows;

        $row = ['No.', 'Who', 'Likes'];
        $input->addHeaderRow($row);
        $input->addHeaderRows([$row]);

        $rows[] = $row;
        $rows[] = $row;

        $this->assertSame($input->getHeaderRows(), $rows);
    }

    public function test_GetSetDataRows()
    {
        $input = clone $this->_input;
        $rows = $this->_dataRows;

        $row = ['4', 'Peter', 'Unit tests'];
        $rows[] = $row;
        $rows[] = $row;

        $input->setDataRows($rows);
        $this->assertSame($input->getDataRows(), $rows);
    }

    public function test_AddDataRows()
    {
        $input = clone $this->_input;
        $rows = $this->_dataRows;

        $row = ['4', 'Peter', 'Unit tests'];
        $input->addDataRow($row);
        $input->addDataRows([$row]);

        $rows[] = $row;
        $rows[] = $row;

        $this->assertSame($input->getDataRows(), $rows);
    }
}