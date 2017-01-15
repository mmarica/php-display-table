<?php
namespace Mmarica\DisplayTable\Output;

use Mmarica\DisplayTable\Input\AbstractInput;


/**
 * Abstract Output Class
 */
abstract class AbstractOutput
{
    /**
     * @var AbstractInput
     */
    protected $_input;

    /**
     * AbstractOutput constructor
     *
     * @param AbstractInput $input Input object
     */
    public function __construct($input)
    {
        $this->_input = $input;
    }

    /**
     * Generate the table output
     *
     * @return string
     */
    public abstract function generate();
}