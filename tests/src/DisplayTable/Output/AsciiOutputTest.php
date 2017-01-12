<?php
namespace Tests\DisplayTable\Output;

use Tests\AbstractTest;
use Mmarica\DisplayTable\Input\AbstractInput;
use Mmarica\DisplayTable\Input\ArrayInput;
use Mmarica\DisplayTable\Output;


class AsciiOutputTest extends AbstractTest
{
    /**
     * @var AbstractInput
     */
    protected $_oneHeaderNoRows;

    /**
     * @var AbstractInput
     */
    protected $_noHeadersOneRow;

    /**
     * @var AbstractInput
     */
    protected $_noHeadersMultipleRows;

    /**
     * @var array
     */
    protected $_oneHeaderMultipleRows;

    /**
     * @var array
     */
    protected $_dataRows;

    protected function setUp()
    {
        parent::setUp();

        $header = array('#', 'Person', 'Hobbies');
        $rows = array(
            array('1', 'Mihai', 'Cycling, Gaming, Programming'),
            array('2', 'Chewbacca', 'Growling, hibernating'),
            array('3', 'Philip J. Fry', 'Time traveling, eating anchovies'),
        );

        // ready-to-use inputs
        $this->_oneHeaderNoRows = new ArrayInput($header);
        $this->_noHeadersOneRow = new ArrayInput(array(), array($rows[0]));
        $this->_noHeadersMultipleRows = new ArrayInput(array(), $rows);
        $this->_oneHeaderMultipleRows = new ArrayInput($header, $rows);
    }

    public function test_NoPadding()
    {
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $result = $output->noPadding()->generate();
        $expected = $this->_loadTxtResource(__METHOD__);
        $this->assertSame($expected, $result);
    }

    public function test_CustomPadding()
    {
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);

        $this->assertSame($output->hPadding(2)->getHPadding(), 2);
        $this->assertSame($output->vPadding(1)->getVPadding(), 1);

        $result = $output->generate();
        $expected = $this->_loadTxtResource(__METHOD__);
        $this->assertSame($expected, $result);
    }

    public function test_GetBorderType()
    {
        $output = new Output\AsciiOutput();
        $this->assertSame($output->mysqlBorder()->getBorderType(), Output\Ascii\BorderFactory::MYSQL_BORDER);
    }

    public function test_BubbleBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_BubbleBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_BubbleBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_BubbleBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_CompactBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_CompactBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_CompactBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_CompactBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_DifferentiatedBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DifferentiatedBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DifferentiatedBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DifferentiatedBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DottedBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_DottedBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_DottedBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_DottedBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_GirderBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GirderBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GirderBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GirderBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GithubBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_GithubBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_GithubBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_GithubBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_MysqlBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_MysqlBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_MysqlBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_MysqlBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_NoBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_NoBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_NoBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_NoBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_RoundedBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_RoundedBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_RoundedBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_RoundedBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadTxtResource(__METHOD__);
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }
}