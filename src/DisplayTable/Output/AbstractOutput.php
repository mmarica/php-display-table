<?php
namespace Mmarica\DisplayTable\Output;

use Mmarica\DisplayTable\Input\AbstractInput;
use Mmarica\DisplayTable\Input\DefaultInput;


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
     * @param null|AbstractInput $input (optional) Input object
     */
    public function __construct($input = null)
    {
        if (is_null($input))
            $input = new DefaultInput();

        $this->_input = $input;
    }

    /**
     * Generate the table output
     *
     * @return string
     */
    public abstract function generate();
}