<?php
namespace Tests\DisplayTable;

use Mmarica\DisplayTable\Input\AbstractInput;
use Mmarica\DisplayTable\Input\ArrayInput;
use Mmarica\DisplayTable\Output;
use PHPUnit_Framework_TestCase;


class AsciiOutputTest extends PHPUnit_Framework_TestCase
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

        // ready to use inputs
        $this->_oneHeaderNoRows = new ArrayInput($header);
        $this->_noHeadersOneRow = new ArrayInput(array(), array($rows[0]));
        $this->_noHeadersMultipleRows = new ArrayInput(array(), $rows);
        $this->_oneHeaderMultipleRows = new ArrayInput($header, $rows);
    }

    public function test_NoPadding()
    {
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $result = $output->noPadding()->generate();

        $expected = <<<'EOD'
.-.-------------.--------------------------------.
|#|   Person    |            Hobbies             |
:-+-------------+--------------------------------:
|1|Mihai        |Cycling, Gaming, Programming    |
|2|Chewbacca    |Growling, hibernating           |
|3|Philip J. Fry|Time traveling, eating anchovies|
'-'-------------'--------------------------------'

EOD;
        $this->assertSame($expected, $result);
    }

    public function test_CustomPadding()
    {
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);

        $this->assertSame($output->hPadding(2)->getHPadding(), 2);
        $this->assertSame($output->vPadding(1)->getVPadding(), 1);

        $result = $output->generate();

        $expected = <<<'EOD'
.-----.-----------------.------------------------------------.
|     |                 |                                    |
|  #  |     Person      |              Hobbies               |
|     |                 |                                    |
:-----+-----------------+------------------------------------:
|     |                 |                                    |
|  1  |  Mihai          |  Cycling, Gaming, Programming      |
|     |                 |                                    |
|     |                 |                                    |
|  2  |  Chewbacca      |  Growling, hibernating             |
|     |                 |                                    |
|     |                 |                                    |
|  3  |  Philip J. Fry  |  Time traveling, eating anchovies  |
|     |                 |                                    |
'-----'-----------------'------------------------------------'

EOD;
        $this->assertSame($expected, $result);
    }

    public function test_GetBorderType()
    {
        $output = new Output\AsciiOutput();
        $this->assertSame($output->mysqlBorder()->getBorderType(), Output\Ascii\BorderFactory::MYSQL_BORDER);
    }

    public function test_RoundedBorder_OneHeaderNoRows()
    {
        $expected = <<<'EOD'
.---.--------.---------.
| # | Person | Hobbies |
'---'--------'---------'

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_RoundedBorder_NoHeadersOneRow()
    {
        $expected = <<<'EOD'
.---.-------.------------------------------.
| 1 | Mihai | Cycling, Gaming, Programming |
'---'-------'------------------------------'

EOD;
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_RoundedBorder_oneHeaderMultipleRows()
    {
        $expected = <<<'EOD'
.---.---------------.----------------------------------.
| # |    Person     |             Hobbies              |
:---+---------------+----------------------------------:
| 1 | Mihai         | Cycling, Gaming, Programming     |
| 2 | Chewbacca     | Growling, hibernating            |
| 3 | Philip J. Fry | Time traveling, eating anchovies |
'---'---------------'----------------------------------'

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_MysqlBorder_OneHeaderNoRows()
    {
        $expected = <<<'EOD'
+---+--------+---------+
| # | Person | Hobbies |
+---+--------+---------+

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_MysqlBorder_NoHeadersOneRow()
    {
        $expected = <<<'EOD'
+---+-------+------------------------------+
| 1 | Mihai | Cycling, Gaming, Programming |
+---+-------+------------------------------+

EOD;
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_MysqlBorder_OneHeaderMultipleRows()
    {
        $expected = <<<'EOD'
+---+---------------+----------------------------------+
| # |    Person     |             Hobbies              |
+---+---------------+----------------------------------+
| 1 | Mihai         | Cycling, Gaming, Programming     |
| 2 | Chewbacca     | Growling, hibernating            |
| 3 | Philip J. Fry | Time traveling, eating anchovies |
+---+---------------+----------------------------------+

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_DottedBorder_OneHeaderNoRows()
    {
        $expected = <<<'EOD'
........................
: # : Person : Hobbies :
:...:........:.........:

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_DottedBorder_NoHeadersOneRow()
    {
        $expected = <<<'EOD'
............................................
: 1 : Mihai : Cycling, Gaming, Programming :
:...:.......:..............................:

EOD;
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_DottedBorder_oneHeaderMultipleRows()
    {
        $expected = <<<'EOD'
........................................................
: # :    Person     :             Hobbies              :
:...:...............:..................................:
: 1 : Mihai         : Cycling, Gaming, Programming     :
: 2 : Chewbacca     : Growling, hibernating            :
: 3 : Philip J. Fry : Time traveling, eating anchovies :
:...:...............:..................................:

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_GithubBorder_OneHeaderNoRows()
    {
        $expected = <<<'EOD'
| # | Person | Hobbies |

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_GithubBorder_NoHeadersOneRow()
    {
        $expected = <<<'EOD'
| 1 | Mihai | Cycling, Gaming, Programming |

EOD;
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_GithubBorder_OneHeaderMultipleRows()
    {
        $expected = <<<'EOD'
| # |    Person     |             Hobbies              |
|---|---------------|----------------------------------|
| 1 | Mihai         | Cycling, Gaming, Programming     |
| 2 | Chewbacca     | Growling, hibernating            |
| 3 | Philip J. Fry | Time traveling, eating anchovies |

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_DifferentiatedBorder_OneHeaderNoRows()
    {
        $expected = <<<'EOD'
+===+========+=========+
| # | Person | Hobbies |
+===+========+=========+

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DifferentiatedBorder_NoHeadersOneRow()
    {
        $expected = <<<'EOD'
+---+-------+------------------------------+
| 1 | Mihai | Cycling, Gaming, Programming |
+---+-------+------------------------------+

EOD;
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_DifferentiatedBorder_OneHeaderMultipleRows()
    {
        $expected = <<<'EOD'
+===+===============+==================================+
| # |    Person     |             Hobbies              |
+===+===============+==================================+
| 1 | Mihai         | Cycling, Gaming, Programming     |
+---+---------------+----------------------------------+
| 2 | Chewbacca     | Growling, hibernating            |
+---+---------------+----------------------------------+
| 3 | Philip J. Fry | Time traveling, eating anchovies |
+---+---------------+----------------------------------+

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_BubbleBorder_OneHeaderNoRows()
    {
        $expected = <<<'EOD'
 o8===(_)========(_)=========8o 
(_) # (_) Person (_) Hobbies (_)
 o8===(_)========(_)=========8o 

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_BubbleBorder_NoHeadersOneRow()
    {
        $expected = <<<'EOD'
 o8---(_)-------(_)------------------------------8o 
(_) 1 (_) Mihai (_) Cycling, Gaming, Programming (_)
 o8---(_)-------(_)------------------------------8o 

EOD;
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_BubbleBorder_OneHeaderMultipleRows()
    {
        $expected = <<<'EOD'
 o8===(_)===============(_)==================================8o 
(_) # (_)    Person     (_)             Hobbies              (_)
(88===(_)===============(_)==================================88)
(_) 1 (_) Mihai         (_) Cycling, Gaming, Programming     (_)
(88---(_)---------------(_)----------------------------------88)
(_) 2 (_) Chewbacca     (_) Growling, hibernating            (_)
(88---(_)---------------(_)----------------------------------88)
(_) 3 (_) Philip J. Fry (_) Time traveling, eating anchovies (_)
 o8---(_)---------------(_)----------------------------------8o 

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_GirderBorder_OneHeaderNoRows()
    {
        $expected = <<<'EOD'
//===[]========[]=========\\
|| # || Person || Hobbies ||
\\===[]========[]=========//

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GirderBorder_NoHeadersOneRow()
    {
        $expected = <<<'EOD'
//---[]-------[]------------------------------\\
|| 1 || Mihai || Cycling, Gaming, Programming ||
\\---[]-------[]------------------------------//

EOD;
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_GirderBorder_OneHeaderMultipleRows()
    {
        $expected = <<<'EOD'
//===[]===============[]==================================\\
|| # ||    Person     ||             Hobbies              ||
|]===[]===============[]==================================[|
|| 1 || Mihai         || Cycling, Gaming, Programming     ||
|]===[]===============[]==================================[|
|| 2 || Chewbacca     || Growling, hibernating            ||
|]===[]===============[]==================================[|
|| 3 || Philip J. Fry || Time traveling, eating anchovies ||
\\---[]---------------[]----------------------------------//

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_CompactBorder_OneHeaderNoRows()
    {
        $expected = <<<'EOD'
 #  Person  Hobbies 

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_CompactBorder_NoHeadersOneRow()
    {
        $expected = <<<'EOD'
 1  Mihai  Cycling, Gaming, Programming 

EOD;
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_CompactBorder_oneHeaderMultipleRows()
    {
        $expected = <<<'EOD'
 #     Person                  Hobbies              
----------------------------------------------------
 1  Mihai          Cycling, Gaming, Programming     
 2  Chewbacca      Growling, hibernating            
 3  Philip J. Fry  Time traveling, eating anchovies 

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_NoBorder_OneHeaderNoRows()
    {
        $expected = <<<'EOD'
 #  Person  Hobbies 

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_NoBorder_NoHeadersOneRow()
    {
        $expected = <<<'EOD'
 1  Mihai  Cycling, Gaming, Programming 

EOD;
        $output = new Output\AsciiOutput($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->noBorder()->generate());
    }

    public function test_NoBorder_OneHeaderMultipleRows()
    {
        $expected = <<<'EOD'
 #     Person                  Hobbies              
 1  Mihai          Cycling, Gaming, Programming     
 2  Chewbacca      Growling, hibernating            
 3  Philip J. Fry  Time traveling, eating anchovies 

EOD;
        $output = new Output\AsciiOutput($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->noBorder()->generate());
    }
}