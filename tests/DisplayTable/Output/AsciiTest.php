<?php
namespace Tests\DisplayTable;

use Mmarica\DisplayTable\Input;
use Mmarica\DisplayTable\Output;
use PHPUnit_Framework_TestCase;


class AsciiTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Input\AbstractInput
     */
    protected $_oneHeaderNoRows;

    /**
     * @var Input\AbstractInput
     */
    protected $_noHeadersOneRow;

    /**
     * @var Input\AbstractInput
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
        $this->_oneHeaderNoRows = new Input\Arrays($header);
        $this->_noHeadersOneRow = new Input\Arrays(array(), array($rows[0]));
        $this->_noHeadersMultipleRows = new Input\Arrays(array(), $rows);
        $this->_oneHeaderMultipleRows = new Input\Arrays($header, $rows);
    }

    public function test_NoPadding()
    {
        $output = new Output\Ascii($this->_oneHeaderMultipleRows);
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
        $output = new Output\Ascii($this->_oneHeaderMultipleRows);

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
        $output = new Output\Ascii();
        $this->assertSame($output->mysqlBorder()->getBorderType(), Output\Ascii\BorderFactory::MYSQL_BORDER);
    }

    public function test_RoundedBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
.---.--------.---------.
| # | Person | Hobbies |
'---'--------'---------'

EOD;
        $output = new Output\Ascii($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());

        // no headers, one row
        $expected = <<<'EOD'
.---.-------.------------------------------.
| 1 | Mihai | Cycling, Gaming, Programming |
'---'-------'------------------------------'

EOD;
        $output = new Output\Ascii($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->roundedBorder()->generate());

        // one header, multiple rows
        $expected = <<<'EOD'
.---.---------------.----------------------------------.
| # |    Person     |             Hobbies              |
:---+---------------+----------------------------------:
| 1 | Mihai         | Cycling, Gaming, Programming     |
| 2 | Chewbacca     | Growling, hibernating            |
| 3 | Philip J. Fry | Time traveling, eating anchovies |
'---'---------------'----------------------------------'

EOD;
        $output = new Output\Ascii($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->roundedBorder()->generate());
    }

    public function test_MysqlBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
+---+--------+---------+
| # | Person | Hobbies |
+---+--------+---------+

EOD;
        $output = new Output\Ascii($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());

        // no headers, one row
        $expected = <<<'EOD'
+---+-------+------------------------------+
| 1 | Mihai | Cycling, Gaming, Programming |
+---+-------+------------------------------+

EOD;
        $output = new Output\Ascii($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->mysqlBorder()->generate());

        // one header, multiple rows
        $expected = <<<'EOD'
+---+---------------+----------------------------------+
| # |    Person     |             Hobbies              |
+---+---------------+----------------------------------+
| 1 | Mihai         | Cycling, Gaming, Programming     |
| 2 | Chewbacca     | Growling, hibernating            |
| 3 | Philip J. Fry | Time traveling, eating anchovies |
+---+---------------+----------------------------------+

EOD;
        $output = new Output\Ascii($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->mysqlBorder()->generate());
    }

    public function test_DottedBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
........................
: # : Person : Hobbies :
:...:........:.........:

EOD;
        $output = new Output\Ascii($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());

        // no headers, one row
        $expected = <<<'EOD'
............................................
: 1 : Mihai : Cycling, Gaming, Programming :
:...:.......:..............................:

EOD;
        $output = new Output\Ascii($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->dottedBorder()->generate());

        // one header, multiple rows
        $expected = <<<'EOD'
........................................................
: # :    Person     :             Hobbies              :
:...:...............:..................................:
: 1 : Mihai         : Cycling, Gaming, Programming     :
: 2 : Chewbacca     : Growling, hibernating            :
: 3 : Philip J. Fry : Time traveling, eating anchovies :
:...:...............:..................................:

EOD;
        $output = new Output\Ascii($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->dottedBorder()->generate());
    }

    public function test_GithubBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
| # | Person | Hobbies |

EOD;
        $output = new Output\Ascii($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->githubBorder()->generate());

        // no headers, one row
        $expected = <<<'EOD'
| 1 | Mihai | Cycling, Gaming, Programming |

EOD;
        $output = new Output\Ascii($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->githubBorder()->generate());

        // one header, multiple rows
        $expected = <<<'EOD'
| # |    Person     |             Hobbies              |
|---|---------------|----------------------------------|
| 1 | Mihai         | Cycling, Gaming, Programming     |
| 2 | Chewbacca     | Growling, hibernating            |
| 3 | Philip J. Fry | Time traveling, eating anchovies |

EOD;
        $output = new Output\Ascii($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->githubBorder()->generate());
    }

    public function test_DifferentiatedBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
+===+========+=========+
| # | Person | Hobbies |
+===+========+=========+

EOD;
        $output = new Output\Ascii($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());

        // no headers, one row
        $expected = <<<'EOD'
+---+-------+------------------------------+
| 1 | Mihai | Cycling, Gaming, Programming |
+---+-------+------------------------------+

EOD;
        $output = new Output\Ascii($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());

        // one header, multiple rows
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
        $output = new Output\Ascii($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->differentiatedBorder()->generate());
    }

    public function test_BubbleBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
 o8===(_)========(_)=========8o 
(_) # (_) Person (_) Hobbies (_)
 o8===(_)========(_)=========8o 

EOD;
        $output = new Output\Ascii($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());

        // no headers, one row
        $expected = <<<'EOD'
 o8---(_)-------(_)------------------------------8o 
(_) 1 (_) Mihai (_) Cycling, Gaming, Programming (_)
 o8---(_)-------(_)------------------------------8o 

EOD;
        $output = new Output\Ascii($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->bubbleBorder()->generate());

        // one header, multiple rows
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
        $output = new Output\Ascii($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->bubbleBorder()->generate());
    }

    public function test_GirderBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
//===[]========[]=========\\
|| # || Person || Hobbies ||
\\===[]========[]=========//

EOD;
        $output = new Output\Ascii($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->girderBorder()->generate());

        // no headers, one row
        $expected = <<<'EOD'
//---[]-------[]------------------------------\\
|| 1 || Mihai || Cycling, Gaming, Programming ||
\\---[]-------[]------------------------------//

EOD;
        $output = new Output\Ascii($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->girderBorder()->generate());

        // one header, multiple rows
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
        $output = new Output\Ascii($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->girderBorder()->generate());
    }

    public function test_CompactBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
 #  Person  Hobbies 

EOD;
        $output = new Output\Ascii($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->compactBorder()->generate());

        // no headers, one row
        $expected = <<<'EOD'
 1  Mihai  Cycling, Gaming, Programming 

EOD;
        $output = new Output\Ascii($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->compactBorder()->generate());

        // one header, multiple rows
        $expected = <<<'EOD'
 #     Person                  Hobbies              
----------------------------------------------------
 1  Mihai          Cycling, Gaming, Programming     
 2  Chewbacca      Growling, hibernating            
 3  Philip J. Fry  Time traveling, eating anchovies 

EOD;
        $output = new Output\Ascii($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->compactBorder()->generate());
    }

    public function test_NoBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
 #  Person  Hobbies 

EOD;
        $output = new Output\Ascii($this->_oneHeaderNoRows);
        $this->assertSame($expected, $output->noBorder()->generate());

        // no headers, one row
        $expected = <<<'EOD'
 1  Mihai  Cycling, Gaming, Programming 

EOD;
        $output = new Output\Ascii($this->_noHeadersOneRow);
        $this->assertSame($expected, $output->noBorder()->generate());

        // one header, multiple rows
        $expected = <<<'EOD'
 #     Person                  Hobbies              
 1  Mihai          Cycling, Gaming, Programming     
 2  Chewbacca      Growling, hibernating            
 3  Philip J. Fry  Time traveling, eating anchovies 

EOD;
        $output = new Output\Ascii($this->_oneHeaderMultipleRows);
        $this->assertSame($expected, $output->noBorder()->generate());
    }
}