<?php

namespace Mmarica\DisplayTable\Data;

class ArraySource extends AbstractSource
{
    public function __construct($header = array(), $rows = array())
    {
        $this->_header = $header;
        $this->_rows = $rows;
    }
}