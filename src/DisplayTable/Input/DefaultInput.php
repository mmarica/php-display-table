<?php

namespace Mmarica\DisplayTable\Input;

/**
 * Default Input Class
 */
class DefaultInput extends AbstractInput
{
    /**
     * DefaultInput constructor
     *
     * @param array $headerRows Initial header rows
     * @param array $dataRows   Initial data rows
     */
    public function __construct($headerRows = [], $dataRows = [])
    {
        $this->_headerRows = $headerRows;
        $this->_dataRows = $dataRows;
    }
}