<?php

namespace Mmarica\DisplayTable;

use Mmarica\DisplayTable\Data\AbstractSource;


/**
 * Abstract Table Class
 */
abstract class AbstractTable
{
    /**
     * @var AbstractSource
     */
    protected $_dataSource;

    /**
     * TableBase constructor
     *
     */
    protected abstract function __construct();

    /**
     * Create a table instance from an array data source
     *
     * @param array $header Header rows
     * @param array $data   Data rows
     * @return static
     */
    public static function fromArray($header, $data)
    {
        $instance = new static();
        $instance->_setDataSource(new Data\ArraySource($header, $data));

        return $instance;
    }

    /**
     * Generate the table output
     *
     * @return string
     */
    public abstract function generate();

    /**
     * Store the data source object
     *
     * @param Data\AbstractSource $dataSource
     */
    protected function _setDataSource($dataSource)
    {
        $this->_dataSource = $dataSource;
    }
}