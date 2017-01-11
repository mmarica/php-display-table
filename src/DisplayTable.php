<?php
namespace Mmarica;

use Mmarica\DisplayTable\Input;
use Mmarica\DisplayTable\Output;

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
    public static function fromArrays($header = array(), $rows = array())
    {
        $instance = new static();
        $instance->_input = new Input\Arrays($header, $rows);

        return $instance;
    }

    /**
     * Get an Output\Ascii object
     *
     * @return Output\Ascii
     */
    public function toAscii()
    {
        $table = new Output\Ascii($this->_input);
        return $table;
    }
}

