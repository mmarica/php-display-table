<?php

namespace Mmarica\DisplayTable;

/**
 * Ascii Table Class
 * @package Mmarica\DisplayTable
 */
class AsciiTable implements TableInterface
{
    // Possible options
    const OPT_HORIZONTAL_PADDING = 'opt_horizontal_padding';
    const OPT_VERTICAL_PADDING = 'opt_vertical_padding';
    const OPT_BORDERS = 'opt_borders';

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
    const ROUNDED_BORDERS = array(
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
    const DOTS_BORDERS = array(
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
    const MYSQL_BORDERS = array(
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

    // Defaults
    const DEFAULT_OPTIONS = array(
        self::OPT_HORIZONTAL_PADDING => 1,
        self::OPT_VERTICAL_PADDING => 0,
        self::OPT_BORDERS => self::ROUNDED_BORDERS,
    );

    /**
     * @var integer
     */
    protected $_horizontalPadding;

    /**
     * @var integer
     */
    protected $_verticalPadding;

    /**
     * @var array
     */
    protected $_borders;

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
     * @param array $options (optional) List of options
     */
    public function __construct($options = array())
    {
        // apply initialization options (if any)
        $options = array_merge(self::DEFAULT_OPTIONS, $options);

        // extract options into properties
        $this->_horizontalPadding = $options[self::OPT_HORIZONTAL_PADDING];
        $this->_verticalPadding = $options[self::OPT_VERTICAL_PADDING];
        $this->_borders = $options[self::OPT_BORDERS];
    }

    /**
     * Set the horizontal padding
     *
     * @param int $padding Padding value
     * @return void
     */
    public function setHorizontalPadding($padding)
    {
        $this->_horizontalPadding = $padding;
    }

    /**
     * Set the vertical padding
     *
     * @param int $padding Padding value
     * @return void
     */
    public function setVerticalPadding($padding)
    {
        $this->_verticalPadding = $padding;
    }

    /**
     * Set the border character set
     *
     * @param array $borders Border character set
     * @return void
     */
    public function setBorders($borders)
    {
        $this->_borders = $borders;
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

        $output .= $this->_bottomBorder() . PHP_EOL;

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
            $elements[] = str_repeat($this->_borders[self::HORIZONTAL], $length + 2 * $this->_horizontalPadding);

        return $this->_borders[self::TOP_LEFT] . implode($this->_borders[self::TOP_CENTER], $elements) . $this->_borders[self::TOP_RIGHT];
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

        return $this->_borders[self::VERTICAL] . implode($this->_borders[self::VERTICAL], $elements) . $this->_borders[self::VERTICAL];
    }

    /**
     * Add vertical padding to an input string
     *
     * @param string $input The input string
     * @return string
     */
    protected function _verticalPadding($input)
    {
        if ($this->_verticalPadding < 1) {
            return $input;
        }

        $emptyLine = $this->_emptyRow();
        $lines = array();

        for ($padding = 0; $padding < $this->_verticalPadding; $padding++)
            $lines[] = $emptyLine;

        $lines[] = $input;

        for ($padding = 0; $padding < $this->_verticalPadding; $padding++)
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
            $elements[] = str_repeat(' ', $length + 2 * $this->_horizontalPadding);

        return $this->_borders[self::VERTICAL] . implode($this->_borders[self::VERTICAL], $elements) . $this->_borders[self::VERTICAL];
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
            $elements[] = str_repeat($this->_borders[self::HORIZONTAL], $length + 2 * $this->_horizontalPadding);

        return $this->_borders[self::CENTER_LEFT] . implode($this->_borders[self::CENTER_CENTER], $elements) . $this->_borders[self::CENTER_RIGHT];
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

        return $this->_borders[self::VERTICAL] . implode($this->_borders[self::VERTICAL], $elements) . $this->_borders[self::VERTICAL];
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
            $elements[] = str_repeat($this->_borders[self::HORIZONTAL], $length + 2 * $this->_horizontalPadding);

        return $this->_borders[self::BOTTOM_LEFT] . implode($this->_borders[self::BOTTOM_CENTER], $elements) . $this->_borders[self::BOTTOM_RIGHT];
    }

    /**
     * Add horizontal padding to an input string
     *
     * @param string $input The input string
     * @return string
     */
    protected function _horizontalPadding($input)
    {
        if ($this->_horizontalPadding < 1) {
            return $input;
        }

        return str_repeat(' ', $this->_horizontalPadding) . $input . str_repeat(' ', $this->_horizontalPadding);
    }
}