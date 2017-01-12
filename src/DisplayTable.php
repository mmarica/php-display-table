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
     * Create a table instance with an array input
     *
     * @param array $header (optional) Header row
     * @param array $rows   (optional) Data rows
     * @return static
     */
    public static function fromArray($header = array(), $rows = array())
    {
        $instance = new static();
        $instance->_input = new Input\ArrayInput($header, $rows);

        return $instance;
    }

    /**
     * Create a table instance with an array input and no data
     *
     * @return static
     */
    public static function withoutData()
    {
        $instance = new static();
        $instance->_input = new Input\ArrayInput();

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

