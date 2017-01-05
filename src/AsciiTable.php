<?php

namespace Mmarica\DisplayTable;

/**
 * Ascii Table Class
 * @package Mmarica\DisplayTable
 */
class AsciiTable extends TableBase
{
    // Border element types
    const TOP_LEFT = 'top_left';
    const TOP_RIGHT = 'top_right';
    const TOP_CENTER = 'top_center';
    const CENTER_CENTER = 'center_center';
    const CENTER_LEFT = 'center_left';
    const CENTER_RIGHT = 'center_right';
    const BOTTOM_LEFT = 'bottom_left';
    const BOTTOM_RIGHT = 'bottom_right';
    const BOTTOM_CENTER = 'bottom_center';
    const HORIZONTAL = 'horizontal';
    const VERTICAL = 'vertical';

    // Predefined border styles
    const ROUNDED_BORDER = array(
        self::TOP_LEFT => '.',
        self::TOP_RIGHT => '.',
        self::TOP_CENTER => '.',
        self::CENTER_CENTER => '+',
        self::CENTER_LEFT => ':',
        self::CENTER_RIGHT => ':',
        self::BOTTOM_LEFT => '\'',
        self::BOTTOM_RIGHT => '\'',
        self::BOTTOM_CENTER => '\'',
        self::HORIZONTAL => '-',
        self::VERTICAL => '|',
    );
    const DOTTED_BORDER = array(
        self::TOP_LEFT => '.',
        self::TOP_RIGHT => '.',
        self::TOP_CENTER => '.',
        self::CENTER_CENTER => ':',
        self::CENTER_LEFT => ':',
        self::CENTER_RIGHT => ':',
        self::BOTTOM_LEFT => ':',
        self::BOTTOM_RIGHT => ':',
        self::BOTTOM_CENTER => ':',
        self::HORIZONTAL => '.',
        self::VERTICAL => ':',
    );
    const MYSQL_BORDER = array(
        self::TOP_LEFT => '+',
        self::TOP_RIGHT => '+',
        self::TOP_CENTER => '+',
        self::CENTER_CENTER => '+',
        self::CENTER_LEFT => '+',
        self::CENTER_RIGHT => '+',
        self::BOTTOM_LEFT => '+',
        self::BOTTOM_RIGHT => '+',
        self::BOTTOM_CENTER => '+',
        self::HORIZONTAL => '-',
        self::VERTICAL => '|',
    );

    /**
     * @var integer
     */
    protected $_hPadding;

    /**
     * @var integer
     */
    protected $_vPadding;

    /**
     * @var array
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
     * AsciiTable constructor.
     */
    protected function __construct()
    {
        $this->_hPadding = 1;
        $this->_vPadding = 0;
        $this->_border = self::ROUNDED_BORDER;
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
     * Use MySQL style for border
     *
     * @return self
     */
    public function mysqlBorder()
    {
        $this->_border = self::MYSQL_BORDER;
        return $this;
    }

    /**
     * Use rounded style for border
     *
     * @return self
     */
    public function roundedBorder()
    {
        $this->_border = self::ROUNDED_BORDER;
        return $this;
    }

    /**
     * Use dotted style for border
     *
     * @return self
     */
    public function dottedBorder()
    {
        $this->_border = self::DOTTED_BORDER;
        return $this;
    }

    /**
     * Get the border character set
     *
     * @return array
     */
    public function getBorder()
    {
        return $this->_border;
    }

    /**
     * @inheritdoc
     */
    public function generate(DataSource\Base $data)
    {
        list($this->_columns, $this->_rows) = $data->get();
        $this->_computeColumnLengths();

        $output = $this->_topBorder() . PHP_EOL;

        if (count($this->_columns)) {
            $output .= $this->_verticalPadding($this->_tableHeader()) . PHP_EOL;
            $output .= $this->_centerBorder() . PHP_EOL;
        }

        foreach ($this->_rows as $row)
            $output .= $this->_verticalPadding($this->_dataRow($row)) . PHP_EOL;

        $output .= $this->_bottomBorder();

        return $output;
    }

    /**
     * Compute the maximum length for each column
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
    }

    /**
     * Generate the top border
     *
     * @return string
     */
    protected function _topBorder()
    {
        $elements = array();

        foreach ($this->_columnLengths as $length)
            $elements[] = str_repeat($this->_border[self::HORIZONTAL], $length + 2 * $this->_hPadding);

        return $this->_border[self::TOP_LEFT] . implode($this->_border[self::TOP_CENTER], $elements) . $this->_border[self::TOP_RIGHT];
    }

    /**
     * Generate the table header
     *
     * @return string
     */
    protected function _tableHeader()
    {
        $elements = array();
        foreach ($this->_columnLengths as $index => $length)
            $elements[] = $this->_horizontalPadding(str_pad($this->_columns[$index], $length, ' ', STR_PAD_BOTH));

        return $this->_border[self::VERTICAL] . implode($this->_border[self::VERTICAL], $elements) . $this->_border[self::VERTICAL];
    }

    /**
     * Add vertical padding to an input string
     *
     * @param string $input The input string
     * @return string
     */
    protected function _verticalPadding($input)
    {
        if ($this->_vPadding < 1) {
            return $input;
        }

        $emptyLine = $this->_emptyRow();
        $lines = array();

        for ($padding = 0; $padding < $this->_vPadding; $padding++)
            $lines[] = $emptyLine;

        $lines[] = $input;

        for ($padding = 0; $padding < $this->_vPadding; $padding++)
            $lines[] = $emptyLine;

        return implode(PHP_EOL, $lines);
    }

    /**
     * Generate an empty row (useful for vertical padding)
     *
     * @return string
     */
    protected function _emptyRow()
    {
        $elements = array();
        foreach ($this->_columnLengths as $length)
            $elements[] = str_repeat(' ', $length + 2 * $this->_hPadding);

        return $this->_border[self::VERTICAL] . implode($this->_border[self::VERTICAL], $elements) . $this->_border[self::VERTICAL];
    }

    /**
     * Generate the top border (between the table header and the data rows)
     *
     * @return string
     */
    protected function _centerBorder()
    {
        $elements = array();
        foreach ($this->_columnLengths as $length)
            $elements[] = str_repeat($this->_border[self::HORIZONTAL], $length + 2 * $this->_hPadding);

        return $this->_border[self::CENTER_LEFT] . implode($this->_border[self::CENTER_CENTER], $elements) . $this->_border[self::CENTER_RIGHT];
    }

    /**
     * Generate a data row
     *
     * @return string
     */
    protected function _dataRow($row)
    {
        $elements = array();

        foreach ($this->_columnLengths as $index => $length)
            $elements[] = $this->_horizontalPadding(str_pad($row[$index], $length));

        return $this->_border[self::VERTICAL] . implode($this->_border[self::VERTICAL], $elements) . $this->_border[self::VERTICAL];
    }

    /**
     * Generate the top border
     *
     * @return string
     */
    protected function _bottomBorder()
    {
        $elements = array();
        foreach ($this->_columnLengths as $length)
            $elements[] = str_repeat($this->_border[self::HORIZONTAL], $length + 2 * $this->_hPadding);

        return $this->_border[self::BOTTOM_LEFT] . implode($this->_border[self::BOTTOM_CENTER], $elements) . $this->_border[self::BOTTOM_RIGHT];
    }

    /**
     * Add horizontal padding to an input string
     *
     * @param string $input The input string
     * @return string
     */
    protected function _horizontalPadding($input)
    {
        if ($this->_hPadding < 1) {
            return $input;
        }

        return str_repeat(' ', $this->_hPadding) . $input . str_repeat(' ', $this->_hPadding);
    }
}