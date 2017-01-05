<?php

namespace Mmarica\DisplayTable\DataSource;

abstract class Base
{
    protected $_columns;
    protected $_rows;
    
    public function setColumns($columns)
    {
        $this->_columns = $columns;
    }

    public function getColumns()
    {
        return $this->_columns;
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
        return array($this->_columns, $this->_rows);
    }
}