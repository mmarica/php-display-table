<?php

namespace Mmarica\DisplayTable\Input;

abstract class AbstractInput
{
    protected $_header = array();
    protected $_rows = array();
    
    public function setHeader($header)
    {
        $this->_header = $header;
    }

    public function getHeader()
    {
        return $this->_header;
    }

    public function setRows($rows)
    {
        $this->_rows = $rows;
    }

    public function getRows()
    {
        return $this->_rows;
    }

    public function addRow($row)
    {
        $this->_rows[] = $row;
    }

    public function get()
    {
        return array($this->_header, $this->_rows);
    }
}