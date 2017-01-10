<?php

namespace Tests\DisplayTable;

use Mmarica\DisplayTable\Data;
use Mmarica\DisplayTable\AsciiTable;
use PHPUnit_Framework_TestCase;


class AsciiTableTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Data\AbstractSource
     */
    protected $_dataOneHeaderNoRows;

    /**
     * @var Data\AbstractSource
     */
    protected $_dataNoHeaderOneRow;

    /**
     * @var Data\AbstractSource
     */
    protected $_dataOneHeaderMultipleRows;

    protected function setUp()
    {
        parent::setUp();

        $this->_dataOneHeaderNoRows = new Data\ArraySource(
            array('Only', 'one', 'header', 'row')
        );

        $this->_dataNoHeaderOneRow = new Data\ArraySource(
            array(),
            array(
                array('Only', 'one', 'data', 'row'),
            )
        );

        $this->_dataOneHeaderMultipleRows = new Data\ArraySource(
            array('#', 'Person', 'Hobbies'),
            array(
                array('1', 'Mihai', 'Cycling, Gaming, Programming'),
                array('2', 'Chewbacca', 'Growling'),
                array('3', 'Tudor', 'Diets'),
            )
        );
    }

    public function test_NoPadding()
    {
        $result = AsciiTable::create()->noPadding()
            ->generate($this->_dataOneHeaderMultipleRows);

        $expected = <<<'EOD'
.-.---------.----------------------------.
|#| Person  |          Hobbies           |
:-+---------+----------------------------:
|1|Mihai    |Cycling, Gaming, Programming|
|2|Chewbacca|Growling                    |
|3|Tudor    |Diets                       |
'-'---------'----------------------------'

EOD;
        $this->assertSame($expected, $result);
    }

    public function test_CustomPadding()
    {
        $asciiTable = AsciiTable::create()
            ->hPadding(2)->vPadding(1);

        $this->assertSame($asciiTable->getHPadding(), 2);
        $this->assertSame($asciiTable->getVPadding(), 1);

        $result = $asciiTable->generate($this->_dataOneHeaderMultipleRows);

        $expected = <<<'EOD'
.-----.-------------.--------------------------------.
|     |             |                                |
|  #  |   Person    |            Hobbies             |
|     |             |                                |
:-----+-------------+--------------------------------:
|     |             |                                |
|  1  |  Mihai      |  Cycling, Gaming, Programming  |
|     |             |                                |
|     |             |                                |
|  2  |  Chewbacca  |  Growling                      |
|     |             |                                |
|     |             |                                |
|  3  |  Tudor      |  Diets                         |
|     |             |                                |
'-----'-------------'--------------------------------'

EOD;
        $this->assertSame($expected, $result);
    }

    public function test_GetBorderType()
    {
        $this->assertSame(AsciiTable::create()->mysqlBorder()->getBorderType(), AsciiTable\BorderFactory::MYSQL_BORDER);
    }

    public function test_RoundedBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
.------.-----.--------.-----.
| Only | one | header | row |
'------'-----'--------'-----'

EOD;
        $this->assertSame($expected, AsciiTable::create()->roundedBorder()->generate($this->_dataOneHeaderNoRows));

        // no headers, one row
        $expected = <<<'EOD'
.------.-----.------.-----.
| Only | one | data | row |
'------'-----'------'-----'

EOD;
        $this->assertSame($expected, AsciiTable::create()->roundedBorder()->generate($this->_dataNoHeaderOneRow));

        // one header, multiple rows
        $expected = <<<'EOD'
.---.-----------.------------------------------.
| # |  Person   |           Hobbies            |
:---+-----------+------------------------------:
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |
'---'-----------'------------------------------'

EOD;
        $asciiTable = AsciiTable::create()->roundedBorder();
        $result = $asciiTable->generate($this->_dataOneHeaderMultipleRows);
        $this->assertSame($expected, $result);
    }

    public function test_MysqlBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
+------+-----+--------+-----+
| Only | one | header | row |
+------+-----+--------+-----+

EOD;
        $this->assertSame($expected, AsciiTable::create()->mysqlBorder()->generate($this->_dataOneHeaderNoRows));

        // no headers, one row
        $expected = <<<'EOD'
+------+-----+------+-----+
| Only | one | data | row |
+------+-----+------+-----+

EOD;
        $this->assertSame($expected, AsciiTable::create()->mysqlBorder()->generate($this->_dataNoHeaderOneRow));

        // one header, multiple rows
        $expected = <<<'EOD'
+---+-----------+------------------------------+
| # |  Person   |           Hobbies            |
+---+-----------+------------------------------+
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |
+---+-----------+------------------------------+

EOD;
        $asciiTable = AsciiTable::create()->mysqlBorder();
        $result = $asciiTable->generate($this->_dataOneHeaderMultipleRows);

        $this->assertSame($expected, $result);
    }

    public function test_DottedBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
.............................
: Only : one : header : row :
:......:.....:........:.....:

EOD;
        $this->assertSame($expected, AsciiTable::create()->dottedBorder()->generate($this->_dataOneHeaderNoRows));

        // no headers, one row
        $expected = <<<'EOD'
...........................
: Only : one : data : row :
:......:.....:......:.....:

EOD;
        $this->assertSame($expected, AsciiTable::create()->dottedBorder()->generate($this->_dataNoHeaderOneRow));

        // one header, multiple rows
        $expected = <<<'EOD'
................................................
: # :  Person   :           Hobbies            :
:...:...........:..............................:
: 1 : Mihai     : Cycling, Gaming, Programming :
: 2 : Chewbacca : Growling                     :
: 3 : Tudor     : Diets                        :
:...:...........:..............................:

EOD;
        $this->assertSame($expected, AsciiTable::create()->dottedBorder()->generate($this->_dataOneHeaderMultipleRows));
    }

    public function test_GithubBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
| Only | one | header | row |

EOD;
        $this->assertSame($expected, AsciiTable::create()->githubBorder()->generate($this->_dataOneHeaderNoRows));

        // no headers, one row
        $expected = <<<'EOD'
| Only | one | data | row |

EOD;
        $this->assertSame($expected, AsciiTable::create()->githubBorder()->generate($this->_dataNoHeaderOneRow));

        // one header, multiple rows
        $expected = <<<'EOD'
| # |  Person   |           Hobbies            |
|---|-----------|------------------------------|
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |

EOD;
        $this->assertSame($expected, AsciiTable::create()->githubBorder()->generate($this->_dataOneHeaderMultipleRows));
    }

    public function test_CompleteBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
+======+=====+========+=====+
| Only | one | header | row |
+======+=====+========+=====+

EOD;
        $this->assertSame($expected, AsciiTable::create()->completeBorder()->generate($this->_dataOneHeaderNoRows));

        // no headers, one row
        $expected = <<<'EOD'
+------+-----+------+-----+
| Only | one | data | row |
+------+-----+------+-----+

EOD;
        $this->assertSame($expected, AsciiTable::create()->completeBorder()->generate($this->_dataNoHeaderOneRow));

        // one header, multiple rows
        $expected = <<<'EOD'
+===+===========+==============================+
| # |  Person   |           Hobbies            |
+===+===========+==============================+
| 1 | Mihai     | Cycling, Gaming, Programming |
+---+-----------+------------------------------+
| 2 | Chewbacca | Growling                     |
+---+-----------+------------------------------+
| 3 | Tudor     | Diets                        |
+---+-----------+------------------------------+

EOD;
        $this->assertSame($expected, AsciiTable::create()->completeBorder()->generate($this->_dataOneHeaderMultipleRows));
    }

    public function test_BubbleBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
 o8======(_)=====(_)========(_)=====8o 
(_) Only (_) one (_) header (_) row (_)
 o8======(_)=====(_)========(_)=====8o 

EOD;
        $this->assertSame($expected, AsciiTable::create()->bubbleBorder()->generate($this->_dataOneHeaderNoRows));

        // no headers, one row
        $expected = <<<'EOD'
 o8------(_)-----(_)------(_)-----8o 
(_) Only (_) one (_) data (_) row (_)
 o8------(_)-----(_)------(_)-----8o 

EOD;
        $this->assertSame($expected, AsciiTable::create()->bubbleBorder()->generate($this->_dataNoHeaderOneRow));

        // one header, multiple rows
        $expected = <<<'EOD'
 o8===(_)===========(_)==============================8o 
(_) # (_)  Person   (_)           Hobbies            (_)
(88===(_)===========(_)==============================88)
(_) 1 (_) Mihai     (_) Cycling, Gaming, Programming (_)
(88---(_)-----------(_)------------------------------88)
(_) 2 (_) Chewbacca (_) Growling                     (_)
(88---(_)-----------(_)------------------------------88)
(_) 3 (_) Tudor     (_) Diets                        (_)
 o8---(_)-----------(_)------------------------------8o 

EOD;
        $this->assertSame($expected, AsciiTable::create()->bubbleBorder()->generate($this->_dataOneHeaderMultipleRows));
    }

    public function test_GirderBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
//======[]=====[]========[]=====\\
|| Only || one || header || row ||
\\======[]=====[]========[]=====//

EOD;
        $this->assertSame($expected, AsciiTable::create()->girderBorder()->generate($this->_dataOneHeaderNoRows));

        // no headers, one row
        $expected = <<<'EOD'
//------[]-----[]------[]-----\\
|| Only || one || data || row ||
\\------[]-----[]------[]-----//

EOD;
        $this->assertSame($expected, AsciiTable::create()->girderBorder()->generate($this->_dataNoHeaderOneRow));

        // one header, multiple rows
        $expected = <<<'EOD'
//===[]===========[]==============================\\
|| # ||  Person   ||           Hobbies            ||
|]===[]===========[]==============================[|
|| 1 || Mihai     || Cycling, Gaming, Programming ||
|]===[]===========[]==============================[|
|| 2 || Chewbacca || Growling                     ||
|]===[]===========[]==============================[|
|| 3 || Tudor     || Diets                        ||
\\---[]-----------[]------------------------------//

EOD;
        $this->assertSame($expected, AsciiTable::create()->girderBorder()->generate($this->_dataOneHeaderMultipleRows));
    }

    public function test_CompactBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
 Only  one  header  row 

EOD;
        $this->assertSame($expected, AsciiTable::create()->compactBorder()->generate($this->_dataOneHeaderNoRows));

        // no headers, one row
        $expected = <<<'EOD'
 Only  one  data  row 

EOD;
        $this->assertSame($expected, AsciiTable::create()->compactBorder()->generate($this->_dataNoHeaderOneRow));

        // one header, multiple rows
        $expected = <<<'EOD'
 #   Person              Hobbies            
--------------------------------------------
 1  Mihai      Cycling, Gaming, Programming 
 2  Chewbacca  Growling                     
 3  Tudor      Diets                        

EOD;
        $this->assertSame($expected, AsciiTable::create()->compactBorder()->generate($this->_dataOneHeaderMultipleRows));
    }

    public function test_NoBorder()
    {
        // one header, no rows
        $expected = <<<'EOD'
 Only  one  header  row 

EOD;
        $this->assertSame($expected, AsciiTable::create()->noBorder()->generate($this->_dataOneHeaderNoRows));

        // no headers, one row
        $expected = <<<'EOD'
 Only  one  data  row 

EOD;
        $this->assertSame($expected, AsciiTable::create()->noBorder()->generate($this->_dataNoHeaderOneRow));

        // one header, multiple rows
        $expected = <<<'EOD'
 #   Person              Hobbies            
 1  Mihai      Cycling, Gaming, Programming 
 2  Chewbacca  Growling                     
 3  Tudor      Diets                        

EOD;
        $this->assertSame($expected, AsciiTable::create()->noBorder()->generate($this->_dataOneHeaderMultipleRows));
    }
}