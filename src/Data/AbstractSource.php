<?php

namespace Mmarica\DisplayTable\Data;

abstract class AbstractSource
{
    protected $_header;
    protected $_rows;
    
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