<?php
namespace Mmarica\DisplayTable\Input;


/**
 * Abstract Input Class
 */
abstract class AbstractInput
{
    /**
     * @var array
     */
    protected $_headerRows = [];

    /**
     * @var array
     */
    protected $_dataRows = [];

    /**
     * Set the header rows
     *
     * @param array $headerRows Header rows
     */
    public function setHeaderRows($headerRows)
    {
        $this->_headerRows = $headerRows;
    }

    /**
     * Get the header rows
     *
     * @return array
     */
    public function getHeaderRows()
    {
        return $this->_headerRows;
    }

    /**
     * Set the data rows
     *
     * @param array $dataRows Data rows
     */
    public function setDataRows($dataRows)
    {
        $this->_dataRows = $dataRows;
    }

    /**
     * Get the data rows
     *
     * @return array
     */
    public function getDataRows()
    {
        return $this->_dataRows;
    }

    /**
     * Add a header row
     *
     * @param array $headerRow Header row to add
     */
    public function addHeaderRow($headerRow)
    {
        $this->_headerRows[] = $headerRow;
    }

    /**
     * Add header rows
     *
     * @param array $headerRows Header rows to add
     */
    public function addHeaderRows($headerRows)
    {
        $this->_headerRows = array_merge($this->_headerRows, $headerRows);
    }

    /**
     * Add a data row
     *
     * @param array $dataRow Data row to add
     */
    public function addDataRow($dataRow)
    {
        $this->_dataRows[] = $dataRow;
    }

    /**
     * Add data rows
     *
     * @param array $dataRows Data rows to add
     */
    public function addDataRows($dataRows)
    {
        $this->_dataRows = array_merge($this->_dataRows, $dataRows);
    }

    /**
     * Get the list of header rows and data rows
     *
     * @return array
     */
    public function get()
    {
        return [$this->_headerRows, $this->_dataRows];
    }
}