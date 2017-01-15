<?php

namespace Mmarica\DisplayTable\Input;

/**
 * Default Input Class
 */
class DefaultInput extends AbstractInput
{
    public function __construct($headerRows = array(), $dataRows = array())
    {
        $this->_headerRows = $headerRows;
        $this->_dataRows = $dataRows;
    }
}