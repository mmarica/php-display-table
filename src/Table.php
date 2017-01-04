<?php

namespace Mmarica\DisplayTable;

require "TemplateInterface.php";
require "Template/Ascii.php";

class Table
{
    protected $_columnNames;
    protected $_rows;

    public function __construct($columnNames = array(), $rows = array())
    {
        $this->_columnNames = $columnNames;
        $this->_rows = $rows;
    }

    public function setColumnNames($columnNames)
    {
        $this->_columnNames = $columnNames;
    }

    public function setRows($rows)
    {
        $this->_rows = $rows;
    }

    public function addRow($row)
    {
        $this->_rows[] = $row;
    }

    public function generate(TemplateInterface $template)
    {
        return $template->getOutput($this->_columnNames, $this->_rows);
    }
}