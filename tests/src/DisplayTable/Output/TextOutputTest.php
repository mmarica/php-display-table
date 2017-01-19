<?php
namespace Tests\DisplayTable\Output;

use Tests\AbstractTest;
use Mmarica\DisplayTable\Input\AbstractInput;
use Mmarica\DisplayTable\Input\DefaultInput;
use Mmarica\DisplayTable\Output\TextOutput;
use Mmarica\DisplayTable\Output\Text\BorderFactory;


class TextOutputTest extends AbstractTest
{
    /**
     * @var AbstractInput
     */
    protected $_noHeadersOneRow;

    /**
     * @var AbstractInput
     */
    protected $_oneHeaderNoRows;

    /**
     * @var AbstractInput
     */
    protected $_noHeadersMultipleRows;

    /**
     * @var AbstractInput
     */
    protected $_oneHeaderMultipleRows;

    /**
     * @var AbstractInput
     */
    protected $_multipleHeadersNoRows;

    /**
     * @var AbstractInput
     */
    protected $_multipleHeadersMultipleRows;

    protected function setUp()
    {
        parent::setUp();

        $headers = [
            ['#', 'Person', 'Hobbies'],
            ['-', '(who)', '(what)'],
        ];
        $rows = [
            ['1', 'Mihai', 'Cycling, Gaming, Programming'],
            ['2', 'Chewbacca', 'Growling, hibernating'],
            ['3', 'Philip J. Fry', 'Time traveling, eating anchovies'],
        ];

        // ready-to-use inputs
        $this->_noHeadersOneRow = new DefaultInput([], [$rows[0]]);
        $this->_noHeadersMultipleRows = new DefaultInput([], $rows);
        $this->_oneHeaderNoRows = new DefaultInput([$headers[0]]);
        $this->_oneHeaderMultipleRows = new DefaultInput([$headers[0]], $rows);
        $this->_multipleHeadersNoRows = new DefaultInput($headers, []);
        $this->_multipleHeadersMultipleRows = new DefaultInput($headers, $rows);
    }

    public function test_NoPadding()
    {
        $output = new TextOutput($this->_oneHeaderMultipleRows);
        $result = $output->noPadding()->generate();
        $expected = $this->_loadResource(__METHOD__);
        $this->assertSame($expected, $result);
    }

    public function test_CustomPadding()
    {
        $output = new TextOutput($this->_oneHeaderMultipleRows);
        $result = $output->hPadding(2)->vPadding(1)->generate();

        $expected = $this->_loadResource(__METHOD__);
        $this->assertSame($expected, $result);

        $this->assertSame($output->getHPadding(), 2);
        $this->assertSame($output->getVPadding(), 1);
    }

    public function test_GetBorderType()
    {
        $output = new TextOutput(new DefaultInput());
        $this->assertSame($output->mysqlBorder()->getBorderType(), BorderFactory::MYSQL_BORDER);
    }

    public function test_BubbleBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_BubbleBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_BubbleBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_BubbleBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_BubbleBorder_MultipleHeadersNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersNoRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_BubbleBorder_MultipleHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersMultipleRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_CompactBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_CompactBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_CompactBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_CompactBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_CompactBorder_MultipleHeadersNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersNoRows);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_CompactBorder_MultipleHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersMultipleRows);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_DifferentiatedBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DifferentiatedBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DifferentiatedBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DifferentiatedBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DifferentiatedBorder_MultipleHeadersNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersNoRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DifferentiatedBorder_MultipleHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersMultipleRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DottedBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_DottedBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_DottedBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_DottedBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_DottedBorder_MultipleHeadersNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersNoRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_DottedBorder_MultipleHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersMultipleRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_GirderBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GirderBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GirderBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GirderBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GirderBorder_MultipleHeadersNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersNoRows);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GirderBorder_MultipleHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersMultipleRows);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GithubBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_GithubBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_GithubBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_GithubBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_GithubBorder_MultipleHeadersNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersNoRows);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_GithubBorder_MultipleHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersMultipleRows);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_MysqlBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_MysqlBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_MysqlBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_MysqlBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_MysqlBorder_MultipleHeadersNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersNoRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_MysqlBorder_MultipleHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersMultipleRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_NoBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_NoBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_NoBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_NoBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_NoBorder_MultipleHeadersNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersNoRows);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_NoBorder_MultipleHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersMultipleRows);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_RoundedBorder_NoHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersMultipleRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_RoundedBorder_NoHeadersOneRow()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_RoundedBorder_OneHeaderMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_RoundedBorder_OneHeaderNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_RoundedBorder_MultipleHeadersNoRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersNoRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_RoundedBorder_MultipleHeadersMultipleRows()
    {
        $expected = $this->_loadResource(__METHOD__);
        $output = new TextOutput($this->_multipleHeadersMultipleRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }
}