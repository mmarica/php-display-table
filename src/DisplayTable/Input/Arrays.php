<?php

namespace Mmarica\DisplayTable\Input;

class Arrays extends AbstractInput
{
    public function __construct($header = array(), $rows = array())
    {
        $this->_header = $header;
        $this->_rows = $rows;
    }
}