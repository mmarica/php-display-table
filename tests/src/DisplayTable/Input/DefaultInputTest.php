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
    protected $_columns;

    /**
     * @var array
     */
    protected $_rows;

    protected function setUp()
    {
        parent::setUp();
        $this->_input = new DefaultInput($this->_columns, $this->_rows);
    }

    public function test_Get()
    {
        list($columns, $rows) = $this->_input->get();
        $this->assertSame($columns, $this->_columns);
        $this->assertSame($rows, $this->_rows);
    }

    public function test_GetSetRows()
    {
        $data = clone $this->_input;

        $row = array('4', 'Peter', 'Unit tests');
        $data->addDataRow($row);

        $rows = $this->_rows;
        $rows[] = $row;

        $this->assertSame($data->getDataRows(), $rows);

        $data->setDataRows($this->_rows);
        $this->assertSame($data->getDataRows(), $this->_rows);
    }

    public function test_GetSetColumns()
    {
        $data = clone $this->_input;

        $columns = array('No.', 'Who', 'Likes');
        $data->setHeaderRows($columns);

        $this->assertSame($data->getHeaderRows(), $columns);
    }
}