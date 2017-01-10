<?php

namespace Mmarica\DisplayTable;

/**
 * Ascii Table Class
 * @package Mmarica\DisplayTable
 */
class AsciiTable extends TableBase
{
    // Border styles
    const NO_BORDER = 'no_border';
    const ROUNDED_BORDER = 'rounded_border';
    const DOTTED_BORDER = 'dotted_border';
    const MYSQL_BORDER = 'mysql_border';
    const GITHUB_BORDER = 'github_border';
    const COMPLETE_BORDER = 'complete_border';
    const COMPACT_BORDER = 'compact_border';
    const BUBBLE_BORDER = 'bubble_border';
    const GIRDER_BORDER = 'girder_border';

    /**
     * @var integer
     */
    protected $_hPadding;

    /**
     * @var integer
     */
    protected $_vPadding;

    /**
     * @var string
     */
    protected $_borderType;

    /**
     * @var AsciiTable\AbstractBorder
     */
    protected $_border;

    /**
     * @var array
     */
    protected $_columns;

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
    protected $_paddedColumns;

    /**
     * @var array
     */
    protected $_paddedSpaces;

    /**
     * @var array
     */
    protected $_paddedRows;

    /**
     * AsciiTable constructor.
     */
    protected function __construct()
    {
        $this->_hPadding = 1;
        $this->_vPadding = 0;
        $this->_borderType = self::ROUNDED_BORDER;
    }

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
     * No border at all
     *
     * @return self
     */
    public function noBorder()
    {
        $this->_borderType = self::NO_BORDER;
        return $this;
    }

    /**
     * Use MySQL style for border
     *
     * @return self
     */
    public function mysqlBorder()
    {
        $this->_borderType = self::MYSQL_BORDER;
        return $this;
    }

    /**
     * Use complete style for border
     *
     * @return self
     */
    public function completeBorder()
    {
        $this->_borderType = self::COMPLETE_BORDER;
        return $this;
    }

    /**
     * Use rounded style for border
     *
     * @return self
     */
    public function roundedBorder()
    {
        $this->_borderType = self::ROUNDED_BORDER;
        return $this;
    }

    /**
     * Use dotted style for border
     *
     * @return self
     */
    public function dottedBorder()
    {
        $this->_borderType = self::DOTTED_BORDER;
        return $this;
    }

    /**
     * Use GitHub style for border
     *
     * @return self
     */
    public function githubBorder()
    {
        $this->_borderType = self::GITHUB_BORDER;
        return $this;
    }

    /**
     * Use compact style for border
     *
     * @return self
     */
    public function compactBorder()
    {
        $this->_borderType = self::COMPACT_BORDER;
        return $this;
    }

    /**
     * Use bubble style for border
     *
     * @return self
     */
    public function bubbleBorder()
    {
        $this->_borderType = self::BUBBLE_BORDER;
        return $this;
    }

    /**
     * Use girder style for border
     *
     * @return self
     */
    public function girderBorder()
    {
        $this->_borderType = self::GIRDER_BORDER;
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
    public function generate(DataSource\Base $data)
    {
        list($this->_columns, $this->_rows) = $data->get();
        $this->_computeColumnLengths();
        $this->_computePaddedElements();

        $this->_border = $this->_createBorderObject();

        // the header section of the table
        if (count($this->_columns)) {
            $headerVPaddingLines = $this->_vPadding > 0 ? str_repeat($this->_border->headerContent($this->_paddedSpaces), $this->_vPadding) : '';

            $output = $this->_border->headerTop();
            $output .= $headerVPaddingLines;
            $output .= $this->_border->headerContent($this->_paddedColumns);
            $output .= $headerVPaddingLines;

            $output .= $this->_border->headerIntersection();
        } else {
            $output = $this->_border->dataTop();
        }

        // the data section of the table
        if (count($this->_paddedRows)) {
            $dataVPaddingLines = $this->_vPadding > 0 ? str_repeat($this->_border->dataContent($this->_paddedSpaces), $this->_vPadding) : '';

            $dataParts = array();

            foreach ($this->_paddedRows as $row) {
                $dataPart = $dataVPaddingLines;
                $dataPart .= $this->_border->dataContent($row);
                $dataPart .= $dataVPaddingLines;

                $dataParts[] = $dataPart;
            }

            $output .= implode($this->_border->dataIntersection(), $dataParts);
            $output .= $this->_border->dataBottom();
        }

        return $output;
    }

    /**
     * Create a border object instance based on the border type
     *
     * @return AsciiTable\AbstractBorder
     * @throws \Exception
     */
    protected function _createBorderObject()
    {
        switch ($this->_borderType) {
            case self::NO_BORDER:
                return new AsciiTable\NoBorder($this->_paddedColumnLengths);

            case self::ROUNDED_BORDER:
                return new AsciiTable\RoundedBorder($this->_paddedColumnLengths);

            case self::DOTTED_BORDER:
                return new AsciiTable\DottedBorder($this->_paddedColumnLengths);

            case self::MYSQL_BORDER:
                return new AsciiTable\MysqlBorder($this->_paddedColumnLengths);

            case self::GITHUB_BORDER:
                return new AsciiTable\GithutBorder($this->_paddedColumnLengths);

            case self::COMPLETE_BORDER:
                return new AsciiTable\CompleteBorder($this->_paddedColumnLengths);

            case self::COMPACT_BORDER:
                return new AsciiTable\CompactBorder($this->_paddedColumnLengths);

            case self::BUBBLE_BORDER:
                return new AsciiTable\BubbleBorder($this->_paddedColumnLengths);

            case self::GIRDER_BORDER:
                return new AsciiTable\GirderBorder($this->_paddedColumnLengths);

            default:
                throw new \Exception('Invalid border type: ' . $this->_borderType);
        }
    }

    /**
     * Compute the maximum length for each column based on the header and data values
     *
     * @return void
     */
    protected function _computeColumnLengths()
    {
        $lengths = array();

        // if a table header exists, take into account the length of the column names
        if (count($this->_columns)) {
            $index = 0;
            foreach ($this->_columns as $value) {
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
     * Compute header, data and empty rows with horizontal padding
     */
    protected function _computePaddedElements()
    {
        $this->_paddedColumns = array();
        $this->_paddedSpaces = array();

        foreach ($this->_columnLengths as $index => $length) {
            $this->_paddedColumns[] = str_pad($this->_columns[$index], $length + 2 * $this->_hPadding, ' ', STR_PAD_BOTH);
            $this->_paddedSpaces[] = str_repeat(' ', $length + 2 * $this->_hPadding);
        }

        $this->_paddedRows = array();

        foreach ($this->_rows as $row) {
            $paddedRow = array();

            foreach ($this->_columnLengths as $index => $length)
                $paddedRow[] = str_pad(str_pad($row[$index], $length), $length + 2 * $this->_hPadding, ' ', STR_PAD_BOTH);

            $this->_paddedRows[] = $paddedRow;
        }
    }
}