<?php
namespace Mmarica;

use Mmarica\DisplayTable\Input\AbstractInput;
use Mmarica\DisplayTable\Input\CsvFileInput;
use Mmarica\DisplayTable\Input\DefaultInput;
use Mmarica\DisplayTable\Output;


/**
 * Display Table Class
 */
class DisplayTable
{
    /**
     * @var AbstractInput
     */
    protected $_input;

    /**
     * DisplayTable constructor
     */
    private function __construct() {}

    /**
     * Create a table instance without any data
     *
     * @return static
     */
    public static function create()
    {
        $instance = new static();
        $instance->_input = new DefaultInput();

        return $instance;
    }

    /**
     * Create a table instance with data from a CSV file input
     *
     * @param string $filename The CSV file path and name
     * @param int    $headerCount The number of lines from the file that should be considered as header
     * @param string $delimiter   The delimiter used to separate elements of a line
     * @return static
     */
    public static function fromCsv($filename, $headerCount = 1, $delimiter = ',')
    {
        $instance = new static();
        $instance->_input = new CsvFileInput($filename, $headerCount, $delimiter);

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

    /**
     * Add one header row
     *
     * @param array $row Header row
     * @return static
     */
    public function headerRow($row)
    {
        $this->_input->addHeaderRow($row);
        return $this;
    }

    /**
     * Add multiple header rows
     *
     * @param array $rows Header rows
     * @return static
     */
    public function headerRows($rows)
    {
        $this->_input->addHeaderRows($rows);
        return $this;
    }

    /**
     * Add one data row
     *
     * @param array $row Data row
     * @return static
     */
    public function dataRow($row)
    {
        $this->_input->addDataRow($row);
        return $this;
    }

    /**
     * Add multiple data rows
     *
     * @param array $rows Data rows
     * @return static
     */
    public function dataRows($rows)
    {
        $this->_input->addDataRows($rows);
        return $this;
    }
}

