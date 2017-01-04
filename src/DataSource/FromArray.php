<?php

namespace Mmarica\DisplayTable\DataSource;

class FromArray extends Base
{
    public function __construct($columns = array(), $rows = array())
    {
        $this->_columns = $columns;
        $this->_rows = $rows;
    }
}