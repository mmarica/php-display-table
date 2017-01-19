<?php
namespace Mmarica\DisplayTable\Input;


/**
 * Abstract Input Class
 */
abstract class AbstractInput
{
    protected $_headerRows = [];
    protected $_dataRows = [];
    
    public function setHeaderRows($header)
    {
        $this->_headerRows = $header;
    }

    public function getHeaderRows()
    {
        return $this->_headerRows;
    }

    public function setDataRows($rows)
    {
        $this->_dataRows = $rows;
    }

    public function getDataRows()
    {
        return $this->_dataRows;
    }

    public function addHeaderRow($row)
    {
        $this->_headerRows[] = $row;
    }

    public function addHeaderRows($rows)
    {
        $this->_headerRows = array_merge($this->_headerRows, $rows);
    }

    public function addDataRow($row)
    {
        $this->_dataRows[] = $row;
    }

    public function addDataRows($rows)
    {
        $this->_dataRows = array_merge($this->_dataRows, $rows);
    }

    public function get()
    {
        return [$this->_headerRows, $this->_dataRows];
    }
}