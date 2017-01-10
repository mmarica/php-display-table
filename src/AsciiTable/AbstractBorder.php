<?php

namespace Mmarica\DisplayTable\AsciiTable;

/**
 * Abstract Border Class
 */
abstract class AbstractBorder
{
    /**
     * The maximum length for each column after padding
     *
     * @var array
     */
    protected $_columnLengths;

    /**
     * Elements of the header top border
     * ht0, ht1, ht2, ht3
     *
     * @var array
     */
    protected $_headerTop = array('', '', '', '');

    /**
     * Glue elements of a header content row (text cells)
     * hc0, hc1, hc2
     *
     * @var array
     */
    protected $_headerContent = array('', '', '');

    /**
     * Elements of the header intersection border (used between two header rows or between a header and the following data row)
     * hi0, hi1, hi2, hi3
     *
     * @var array
     */
    protected $_headerIntersection = array('', '', '', '');

    /**
     * Elements of the header bottom border (used when no data rows follow)
     * hb0, hb1, hb2, hb3
     *
     * @var array
     */
    protected $_headerBottom = array('', '', '', '');

    /**
     * Elements of the data top border (used when no header rows are present)
     * dt0, dt1, dt2, dt3
     *
     * @var array
     */
    protected $_dataTop = array('', '', '', '');

    /**
     * Glue elements of a data content row (text cells)
     * dc0, dc1, dc2
     *
     * @var array
     */
    protected $_dataContent = array('', '', '');

    /**
     * Elements of the data intersection border (between two data rows)
     * di0, di1, di2, di3
     *
     * @var array
     */
    protected $_dataIntersection = array('', '', '', '');

    /**
     * Elements of the data bottom border
     * db0, db1, db2, db3
     *
     * @var array
     */
    protected $_dataBottom = array('', '', '', '');

    /**
     * AbstractBorder constructor.
     *
     * @param array $columnLengths The maximum length for each column after padding
     */
    public function __construct($columnLengths)
    {
        $this->_columnLengths = $columnLengths;
    }

    /**
     * Header section top border
     *
     * @return string
     */
    public function headerTop()
    {
        $elements = array();

        foreach ($this->_columnLengths as $length)
            $elements[] = str_repeat($this->_headerTop[1], $length);

        $result = $this->_headerTop[0] . implode($this->_headerTop[2], $elements) . $this->_headerTop[3];

        if (strlen($result))
            $result .= PHP_EOL;

        return $result;
    }

    /**
     * Header section content row
     *
     * @param array $columns Text for each element from the header row
     * @return string
     */
    public function headerContent($columns)
    {
        return $this->_headerContent[0] . implode($this->_headerContent[1], $columns) . $this->_headerContent[2] .  PHP_EOL;
    }

    /**
     * Header section intersection border (used between two header rows or between a header and the following data row)
     *
     * @return string
     */
    public function headerIntersection()
    {
        $elements = array();

        foreach ($this->_columnLengths as $length)
            $elements[] = str_repeat($this->_headerIntersection[1], $length);

        $result = $this->_headerIntersection[0] . implode($this->_headerIntersection[2], $elements) . $this->_headerIntersection[3];

        if (strlen($result))
            $result .= PHP_EOL;

        return $result;
    }

    /**
     * Data section top border
     *
     * @return string
     */
    public function dataTop()
    {
        $elements = array();

        foreach ($this->_columnLengths as $length)
            $elements[] = str_repeat($this->_dataTop[1], $length);

        $result = $this->_dataTop[0] . implode($this->_dataTop[2], $elements) . $this->_dataTop[3];

        if (strlen($result))
            $result .= PHP_EOL;

        return $result;
    }


    /**
     * Data section content row
     *
     * @param array $values Text for each element from the header row
     * @return string
     */
    public function dataContent($values)
    {
        return $this->_dataContent[0] . implode($this->_dataContent[1], $values) . $this->_dataContent[2] .  PHP_EOL;
    }

    /**
     * Data section intersection border (used between two data rows)
     *
     * @return string
     */
    public function dataIntersection()
    {
        $elements = array();

        foreach ($this->_columnLengths as $length)
            $elements[] = str_repeat($this->_dataIntersection[1], $length);

        $result = $this->_dataIntersection[0] . implode($this->_dataIntersection[2], $elements) . $this->_dataIntersection[3];

        if (strlen($result))
            $result .= PHP_EOL;

        return $result;
    }

    /**
     * Data section bottom border
     *
     * @return string
     */
    public function dataBottom()
    {
        $elements = array();

        foreach ($this->_columnLengths as $length)
            $elements[] = str_repeat($this->_dataBottom[1], $length);

        $result = $this->_dataBottom[0] . implode($this->_dataBottom[2], $elements) . $this->_dataBottom[3];

        if (strlen($result))
            $result .= PHP_EOL;

        return $result;
    }
}