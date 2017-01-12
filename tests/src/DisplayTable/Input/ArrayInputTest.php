<?php
namespace Tests\DisplayTable\Input;

use Tests\AbstractTest;
use Mmarica\DisplayTable\Input;


class ArrayInputTest extends AbstractTest
{
    /**
     * @var Input\AbstractInput
     */
    protected $_input;

    /**
     * @var array
     */
    protected $_columns;

    /**
     * @var array
     */
    protected $_rows;

    protected function setUp()
    {
        parent::setUp();
        $this->_input = new Input\ArrayInput($this->_columns, $this->_rows);
    }

    public function testGet()
    {
        list($columns, $rows) = $this->_input->get();
        $this->assertSame($columns, $this->_columns);
        $this->assertSame($rows, $this->_rows);
    }

    public function testGetSetRows()
    {
        $data = clone $this->_input;

        $row = array('4', 'Peter', 'Unit tests');
        $data->addRow($row);

        $rows = $this->_rows;
        $rows[] = $row;

        $this->assertSame($data->getRows(), $rows);

        $data->setRows($this->_rows);
        $this->assertSame($data->getRows(), $this->_rows);
    }

    public function testGetSetColumns()
    {
        $data = clone $this->_input;

        $columns = array('No.', 'Who', 'Likes');
        $data->setHeader($columns);

        $this->assertSame($data->getHeader(), $columns);
    }
}