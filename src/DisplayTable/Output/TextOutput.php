<?php
namespace Mmarica\DisplayTable\Output;

use Mmarica\DisplayTable\Output\Text\BorderFactory;


/**
 * Text Output Class
 */
class TextOutput extends AbstractOutput
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
     * Use differentiated border
     *
     * @return self
     */
    public function differentiatedBorder()
    {
        $this->_borderType = BorderFactory::DIFFERENTIATED_BORDER;
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
        list($paddedColumnLengths, $paddedHeaderRows, $paddedDataRows, $paddedEmptyRow) = $this->_computePaddedElements();

        $border = BorderFactory::create($this->_borderType, $paddedColumnLengths);
        $output = '';

        // the header section of the table
        $headerCount = 0;
        if (count($paddedHeaderRows)) {
            $headerVPaddingLines = $this->_vPadding > 0 ? str_repeat($border->headerContent($paddedEmptyRow), $this->_vPadding) : '';
            $output .= $border->headerTop();

            $headerParts = [];
            foreach ($paddedHeaderRows as $index => $row) {
                $headerPart = $headerVPaddingLines;
                $headerPart .= $border->headerContent($row);
                $headerPart .= $headerVPaddingLines;

                $headerParts[] = $headerPart;
                $headerCount++;
            }

            $output .= implode($border->headerIntersection(), $headerParts);
            $output .= count($paddedDataRows) ? $border->headerIntersection() : $border->headerBottom();
        }

        if (!$headerCount)
            $output .= $border->dataTop();

        // the data section of the table
        if (count($paddedDataRows)) {
            $dataVPaddingLines = $this->_vPadding > 0 ? str_repeat($border->dataContent($paddedEmptyRow), $this->_vPadding) : '';

            $dataParts = [];
            foreach ($paddedDataRows as $row) {
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
     * Compute header, data and empty row elements with horizontal padding
     */
    protected function _computePaddedElements()
    {
        list($headerRows, $dataRows) = $this->_input->get();

        $lengths = [];

        // if a table header exists, take into account the length of the column names
        if (count($headerRows)) {
            foreach ($headerRows as $row) {
                $index = 0;
                foreach ($row as $value) {
                    $lengths[$index] = strlen($value);
                    $index++;
                }
            }
        }

        // take into account the length of the each element from every data row
        foreach ($dataRows as $row) {
            $index = 0;
            foreach ($row as $value) {
                $lengths[$index] = isset($lengths[$index]) ? max($lengths[$index], strlen($value)) : strlen($value);
                $index++;
            }
        }

        // compute the padded column lengths by adding the horizontal padding
        $paddedColumnLengths = array_map(
            function($length) {
                return $length + 2 * $this->_hPadding;
            }
            , $lengths
        );

        // header rows with horizontal padding
        $paddedHeaderRows = [];
        foreach ($headerRows as $row) {
            $paddedRow = [];

            foreach ($lengths as $index => $length)
                $paddedRow[] = str_pad(isset($row[$index]) ? $row[$index] : '', $length + 2 * $this->_hPadding, ' ', STR_PAD_BOTH);

            $paddedHeaderRows[] = $paddedRow;
        }

        // data rows with horizontal padding
        $paddedDataRows = [];
        foreach ($dataRows as $row) {
            $paddedRow = [];

            foreach ($lengths as $index => $length)
                $paddedRow[] = str_pad(str_pad(isset($row[$index]) ? $row[$index] : '', $length), $length + 2 * $this->_hPadding, ' ', STR_PAD_BOTH);

            $paddedDataRows[] = $paddedRow;
        }

        // empty row with horizontal padding
        $paddedEmptyRow = [];
        foreach ($lengths as $index => $length) {
            $paddedEmptyRow[] = str_repeat(' ', $length + 2 * $this->_hPadding);
        }

        return array($paddedColumnLengths, $paddedHeaderRows, $paddedDataRows, $paddedEmptyRow);
    }
}