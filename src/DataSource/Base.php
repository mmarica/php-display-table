<?php

namespace Mmarica\DisplayTable\DataSource;

class Base
{
    protected $_columns;
    protected $_rows;
    
    public function setColumns($columnNames)
    {
        $this->_columns = $columnNames;
    }

    public function setRows($rows)
    {
        $this->_rows = $rows;
    }

    public function addRow($row)
    {
        $this->_rows[] = $row;
    }

    public function get()
    {
        return array($this->_columns, $this->_rows);
    }
}