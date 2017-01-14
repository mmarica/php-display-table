<?php
namespace Mmarica;

use Mmarica\DisplayTable\Input;
use Mmarica\DisplayTable\Output;


/**
 * Display Table Class
 */
class DisplayTable
{
    /**
     * @var Input\AbstractInput
     */
    protected $_input;

    /**
     * DisplayTable constructor
     *
     */
    protected function __construct() {}

    /**
     * Create a table instance with data from an array
     *
     * @param array $headers (optional) Header rows
     * @param array $data    (optional) Data rows
     * @return static
     */
    public static function fromArray($headers = array(), $data = array())
    {
        $instance = new static();
        $instance->_input = new Input\DefaultInput($headers, $data);

        return $instance;
    }

    /**
     * Create a table instance without any data
     *
     * @return static
     */
    public static function withoutData()
    {
        $instance = new static();
        $instance->_input = new Input\DefaultInput();

        return $instance;
    }

    /**
     * Get a Text Output object
     *
     * @return Output\TextOutput
     */
    public function toText()
    {
        $table = new Output\TextOutput($this->_input);
        return $table;
    }
}

