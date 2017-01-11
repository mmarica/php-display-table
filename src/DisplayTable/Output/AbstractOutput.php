<?php

namespace Mmarica\DisplayTable\Output;

use Mmarica\DisplayTable\Input;


/**
 * Abstract Output Class
 */
abstract class AbstractOutput
{
    /**
     * @var Input\AbstractInput
     */
    protected $_input;

    /**
     * AbstractOutput constructor
     *
     * @param null|Input\AbstractInput $input (optional) Input object
     */
    public function __construct($input = null)
    {
        if (is_null($input))
            $input = new Input\ArrayInput();

        $this->_input = $input;
    }

    /**
     * Generate the table output
     *
     * @return string
     */
    public abstract function generate();
}