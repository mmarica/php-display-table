<?php
namespace Mmarica\DisplayTable\Output;

use Mmarica\DisplayTable\Output\Ascii\BorderFactory;


/**
 * Ascii Table Class
 */
class Ascii extends AbstractOutput
{
    /**
     * @var integer
     */
    protected $_hPadding = 1;

    /**
     * @var integer
     */
    protected $_vPadding = 0;

    /**
     * @var string
     */
    protected $_borderType = BorderFactory::ROUNDED_BORDER;

    /**
     * @var array
     */
    protected $_header;

    /**
     * @var array
     */
    protected $_rows;

    /**
     * @var array
     */
    protected $_columnLengths;

    /**
     * @var array
     */
    protected $_paddedColumnLengths;

    /**
     * @var array
     */
    protected $_paddedHeader;

    /**
     * @var array
     */
    protected $_paddedSpaces;

    /**
     * @var array
     */
    protected $_paddedRows;

    /**
     * Remove horizontal and vertical padding
     *
     * @return self
     */
    public function noPadding()
    {
        $this->_hPadding = 0;
        $this->_vPadding = 0;
        return $this;
    }

    /**
     * Set the horizontal padding
     *
     * @param int $padding Padding value
     * @return self
     */
    public function hPadding($padding)
    {
        $this->_hPadding = $padding;
        return $this;
    }

    /**
     * Get the horizontal padding
     *
     * @return int
     */
    public function getHPadding()
    {
        return $this->_hPadding;
    }

    /**
     * Set the vertical padding
     *
     * @param int $padding Padding value
     * @return self
     */
    public function vPadding($padding)
    {
        $this->_vPadding = $padding;
        return $this;
    }

    /**
     * Get the vertical padding
     *
     * @return int
     */
    public function getVPadding()
    {
        return $this->_vPadding;
    }

    /**
     * Use MySQL border
     *
     * @return self
     */
    public function mysqlBorder()
    {
        $this->_borderType = BorderFactory::MYSQL_BORDER;
        return $this;
    }

    /**
     * Use dotted border
     *
     * @return self
     */
    public function dottedBorder()
    {
        $this->_borderType = BorderFactory::DOTTED_BORDER;
        return $this;
    }

    /**
     * Use GitHub border
     *
     * @return self
     */
    public function githubBorder()
    {
        $this->_borderType = BorderFactory::GITHUB_BORDER;
        return $this;
    }

    /**
     * Use rounded border
     *
     * @return self
     */
    public function roundedBorder()
    {
        $this->_borderType = BorderFactory::ROUNDED_BORDER;
        return $this;
    }

    /**
     * Use complete border
     *
     * @return self
     */
    public function differentiatedBorder()
    {
        $this->_borderType = BorderFactory::DIFFERENTIATED_BORDER;
        return $this;
    }

    /**
     * Use bubble border
     *
     * @return self
     */
    public function bubbleBorder()
    {
        $this->_borderType = BorderFactory::BUBBLE_BORDER;
        return $this;
    }

    /**
     * Use girder border
     *
     * @return self
     */
    public function girderBorder()
    {
        $this->_borderType = BorderFactory::GIRDER_BORDER;
        return $this;
    }

    /**
     * Use compact border
     *
     * @return self
     */
    public function compactBorder()
    {
        $this->_borderType = BorderFactory::COMPACT_BORDER;
        return $this;
    }

    /**
     * Use no border
     *
     * @return self
     */
    public function noBorder()
    {
        $this->_borderType = BorderFactory::NO_BORDER;
        return $this;
    }

    /**
     * Get the border type
     *
     * @return string
     */
    public function getBorderType()
    {
        return $this->_borderType;
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        list($this->_header, $this->_rows) = $this->_input->get();
        $this->_computeColumnLengths();
        $this->_computePaddedElements();

        $border = BorderFactory::create($this->_borderType, $this->_paddedColumnLengths);

        // the header section of the table
        if (count($this->_header)) {
            $headerVPaddingLines = $this->_vPadding > 0 ? str_repeat($border->headerContent($this->_paddedSpaces), $this->_vPadding) : '';

            $output = $border->headerTop();
            $output .= $headerVPaddingLines;
            $output .= $border->headerContent($this->_paddedHeader);
            $output .= $headerVPaddingLines;

            $output .= count($this->_rows) ? $border->headerIntersection() : $border->headerBottom();
        } else {
            $output = $border->dataTop();
        }

        // the data section of the table
        if (count($this->_paddedRows)) {
            $dataVPaddingLines = $this->_vPadding > 0 ? str_repeat($border->dataContent($this->_paddedSpaces), $this->_vPadding) : '';

            $dataParts = array();

            foreach ($this->_paddedRows as $row) {
                $dataPart = $dataVPaddingLines;
                $dataPart .= $border->dataContent($row);
                $dataPart .= $dataVPaddingLines;

                $dataParts[] = $dataPart;
            }

            $output .= implode($border->dataIntersection(), $dataParts);
            $output .= $border->dataBottom();
        }

        return $output;
    }

    /**
     * Compute the maximum length for each column based on the header and data values
     *
     */
    protected function _computeColumnLengths()
    {
        $lengths = array();

        // if a table header exists, take into account the length of the column names
        if (count($this->_header)) {
            $index = 0;
            foreach ($this->_header as $value) {
                $lengths[$index] = strlen($value);
                $index++;
            }
        }

        // take into account the length of the each element from every data row
        foreach ($this->_rows as $row) {
            $index = 0;
            foreach ($row as $value) {
                $lengths[$index] = isset($lengths[$index]) ? max($lengths[$index], strlen($value)) : strlen($value);
                $index++;
            }
        }

        $this->_columnLengths = $lengths;

        // compute the padded column lengths by adding the horizontal padding
        $this->_paddedColumnLengths = array_map(
            function($length) {
                return $length + 2 * $this->_hPadding;
            }
            , $lengths
        );
    }

    /**
     * Compute header, data and empty row elements with horizontal padding
     *
     */
    protected function _computePaddedElements()
    {
        $this->_paddedHeader = array();
        $this->_paddedSpaces = array();

        foreach ($this->_columnLengths as $index => $length) {
            $this->_paddedHeader[] = str_pad(isset($this->_header[$index]) ? $this->_header[$index] : '', $length + 2 * $this->_hPadding, ' ', STR_PAD_BOTH);
            $this->_paddedSpaces[] = str_repeat(' ', $length + 2 * $this->_hPadding);
        }

        $this->_paddedRows = array();

        foreach ($this->_rows as $row) {
            $paddedRow = array();

            foreach ($this->_columnLengths as $index => $length)
                $paddedRow[] = str_pad(str_pad(isset($row[$index]) ? $row[$index] : '', $length), $length + 2 * $this->_hPadding, ' ', STR_PAD_BOTH);

            $this->_paddedRows[] = $paddedRow;
        }
    }
}