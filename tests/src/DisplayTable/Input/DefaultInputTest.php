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
    protected $_headerRows = array('#', 'Person', 'Hobbies');

    /**
     * @var array
     */
    protected $_dataRows = array(
        array('1', 'Mihai', 'Cycling, Gaming, Programming'),
        array('2', 'Chewbacca', 'Growling, hibernating'),
        array('3', 'Philip J. Fry', 'Time traveling, eating anchovies'),
    );

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

        $rows = array(
            array('No.', 'Who', 'Likes')
        );
        $input->setHeaderRows($rows);

        $this->assertSame($input->getHeaderRows(), $rows);
    }

    public function test_AddHeaderRows()
    {
        $input = clone $this->_input;
        $rows = $this->_headerRows;

        $row = array('No.', 'Who', 'Likes');
        $input->addHeaderRow($row);
        $input->addHeaderRows(array($row));

        $rows[] = $row;
        $rows[] = $row;

        $this->assertSame($input->getHeaderRows(), $rows);
    }

    public function test_GetSetDataRows()
    {
        $input = clone $this->_input;
        $rows = $this->_dataRows;

        $row = array('4', 'Peter', 'Unit tests');
        $rows[] = $row;
        $rows[] = $row;

        $input->setDataRows($rows);
        $this->assertSame($input->getDataRows(), $rows);
    }

    public function test_AddDataRows()
    {
        $input = clone $this->_input;
        $rows = $this->_dataRows;

        $row = array('4', 'Peter', 'Unit tests');
        $input->addDataRow($row);
        $input->addDataRows(array($row));

        $rows[] = $row;
        $rows[] = $row;

        $this->assertSame($input->getDataRows(), $rows);
    }
}