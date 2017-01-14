<?php

namespace Mmarica\DisplayTable\Input;

/**
 * Default Input Class
 */
class DefaultInput extends AbstractInput
{
    public function __construct($header = array(), $rows = array())
    {
        $this->_header = $header;
        $this->_rows = $rows;
    }
}