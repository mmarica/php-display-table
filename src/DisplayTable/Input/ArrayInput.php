<?php

namespace Mmarica\DisplayTable\Input;

/**
 * Array Input Class
 */
class ArrayInput extends AbstractInput
{
    public function __construct($header = array(), $rows = array())
    {
        $this->_header = $header;
        $this->_rows = $rows;
    }
}