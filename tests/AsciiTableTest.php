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
    protected $_headerRow;

    /**
     * @var Data\AbstractSource
     */
    protected $_oneDataRow;

    /**
     * @var Data\AbstractSource
     */
    protected $_dataRows;

    protected function setUp()
    {
        parent::setUp();

        $this->_headerRow = array(
            '#', 'Person', 'Hobbies'
        );

        $this->_dataRows = array(
            array('1', 'Mihai', 'Cycling, Gaming, Programming'),
            array('2', 'Chewbacca', 'Growling'),
            array('3', 'Tudor', 'Diets'),
        );
    }

    public function test_NoPadding()
    {
        $result = AsciiTable::fromArray($this->_headerRow, $this->_dataRows)
            ->noPadding()
            ->generate();

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
        $table = AsciiTable::fromArray($this->_headerRow, $this->_dataRows)
            ->hPadding(2)->vPadding(1);

        $this->assertSame($table->getHPadding(), 2);
        $this->assertSame($table->getVPadding(), 1);

        $result = $table->generate();

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
        $table = AsciiTable::fromArray(array(), array())->mysqlBorder();
        $this->assertSame($table->getBorderType(), AsciiTable\BorderFactory::MYSQL_BORDER);
    }

    public function test_RoundedBorder()
    {
        $this->markTestSkipped();

        // one header, no rows
        $expected = <<<'EOD'
.---.--------.---------.
| # | Person | Hobbies |
'---'--------'---------'

EOD;
        $this->assertSame($expected, AsciiTable::fromArray($this->_headerRow, array())->roundedBorder()->generate());

        // no headers, one row
        $expected = <<<'EOD'
.------.-----.--------.-----.
| Only | one | header | row |
'------'-----'--------'-----'

EOD;
        $this->assertSame($expected, AsciiTable::create()->roundedBorder()->generate($this->_oneDataRow));

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
        $result = $asciiTable->generate($this->_dataRows);
        $this->assertSame($expected, $result);
    }

    public function test_MysqlBorder()
    {
        $this->markTestSkipped();

        // one header, no rows
        $expected = <<<'EOD'
+------+-----+--------+-----+
| Only | one | header | row |
+------+-----+--------+-----+

EOD;
        $this->assertSame($expected, AsciiTable::create()->mysqlBorder()->generate($this->_headerRow));

        // no headers, one row
        $expected = <<<'EOD'
+------+-----+------+-----+
| Only | one | data | row |
+------+-----+------+-----+

EOD;
        $this->assertSame($expected, AsciiTable::create()->mysqlBorder()->generate($this->_oneDataRow));

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
        $result = $asciiTable->generate($this->_dataRows);

        $this->assertSame($expected, $result);
    }

    public function test_DottedBorder()
    {
        $this->markTestSkipped();

        // one header, no rows
        $expected = <<<'EOD'
.............................
: Only : one : header : row :
:......:.....:........:.....:

EOD;
        $this->assertSame($expected, AsciiTable::create()->dottedBorder()->generate($this->_headerRow));

        // no headers, one row
        $expected = <<<'EOD'
...........................
: Only : one : data : row :
:......:.....:......:.....:

EOD;
        $this->assertSame($expected, AsciiTable::create()->dottedBorder()->generate($this->_oneDataRow));

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
        $this->assertSame($expected, AsciiTable::create()->dottedBorder()->generate($this->_dataRows));
    }

    public function test_GithubBorder()
    {
        $this->markTestSkipped();

        // one header, no rows
        $expected = <<<'EOD'
| Only | one | header | row |

EOD;
        $this->assertSame($expected, AsciiTable::create()->githubBorder()->generate($this->_headerRow));

        // no headers, one row
        $expected = <<<'EOD'
| Only | one | data | row |

EOD;
        $this->assertSame($expected, AsciiTable::create()->githubBorder()->generate($this->_oneDataRow));

        // one header, multiple rows
        $expected = <<<'EOD'
| # |  Person   |           Hobbies            |
|---|-----------|------------------------------|
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |

EOD;
        $this->assertSame($expected, AsciiTable::create()->githubBorder()->generate($this->_dataRows));
    }

    public function test_CompleteBorder()
    {
        $this->markTestSkipped();

        // one header, no rows
        // one header, no rows
        $expected = <<<'EOD'
+======+=====+========+=====+
| Only | one | header | row |
+======+=====+========+=====+

EOD;
        $this->assertSame($expected, AsciiTable::create()->completeBorder()->generate($this->_headerRow));

        // no headers, one row
        $expected = <<<'EOD'
+------+-----+------+-----+
| Only | one | data | row |
+------+-----+------+-----+

EOD;
        $this->assertSame($expected, AsciiTable::create()->completeBorder()->generate($this->_oneDataRow));

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
        $this->assertSame($expected, AsciiTable::create()->completeBorder()->generate($this->_dataRows));
    }

    public function test_BubbleBorder()
    {
        $this->markTestSkipped();

        // one header, no rows
        $expected = <<<'EOD'
 o8======(_)=====(_)========(_)=====8o 
(_) Only (_) one (_) header (_) row (_)
 o8======(_)=====(_)========(_)=====8o 

EOD;
        $this->assertSame($expected, AsciiTable::create()->bubbleBorder()->generate($this->_headerRow));

        // no headers, one row
        $expected = <<<'EOD'
 o8------(_)-----(_)------(_)-----8o 
(_) Only (_) one (_) data (_) row (_)
 o8------(_)-----(_)------(_)-----8o 

EOD;
        $this->assertSame($expected, AsciiTable::create()->bubbleBorder()->generate($this->_oneDataRow));

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
        $this->assertSame($expected, AsciiTable::create()->bubbleBorder()->generate($this->_dataRows));
    }

    public function test_GirderBorder()
    {
        $this->markTestSkipped();

        // one header, no rows
        $expected = <<<'EOD'
//======[]=====[]========[]=====\\
|| Only || one || header || row ||
\\======[]=====[]========[]=====//

EOD;
        $this->assertSame($expected, AsciiTable::create()->girderBorder()->generate($this->_headerRow));

        // no headers, one row
        $expected = <<<'EOD'
//------[]-----[]------[]-----\\
|| Only || one || data || row ||
\\------[]-----[]------[]-----//

EOD;
        $this->assertSame($expected, AsciiTable::create()->girderBorder()->generate($this->_oneDataRow));

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
        $this->assertSame($expected, AsciiTable::create()->girderBorder()->generate($this->_dataRows));
    }

    public function test_CompactBorder()
    {
        $this->markTestSkipped();

        // one header, no rows
        $expected = <<<'EOD'
 Only  one  header  row 

EOD;
        $this->assertSame($expected, AsciiTable::create()->compactBorder()->generate($this->_headerRow));

        // no headers, one row
        $expected = <<<'EOD'
 Only  one  data  row 

EOD;
        $this->assertSame($expected, AsciiTable::create()->compactBorder()->generate($this->_oneDataRow));

        // one header, multiple rows
        $expected = <<<'EOD'
 #   Person              Hobbies            
--------------------------------------------
 1  Mihai      Cycling, Gaming, Programming 
 2  Chewbacca  Growling                     
 3  Tudor      Diets                        

EOD;
        $this->assertSame($expected, AsciiTable::create()->compactBorder()->generate($this->_dataRows));
    }

    public function test_NoBorder()
    {
        $this->markTestSkipped();

        // one header, no rows
        $expected = <<<'EOD'
 Only  one  header  row 

EOD;
        $this->assertSame($expected, AsciiTable::create()->noBorder()->generate($this->_headerRow));

        // no headers, one row
        $expected = <<<'EOD'
 Only  one  data  row 

EOD;
        $this->assertSame($expected, AsciiTable::create()->noBorder()->generate($this->_oneDataRow));

        // one header, multiple rows
        $expected = <<<'EOD'
 #   Person              Hobbies            
 1  Mihai      Cycling, Gaming, Programming 
 2  Chewbacca  Growling                     
 3  Tudor      Diets                        

EOD;
        $this->assertSame($expected, AsciiTable::create()->noBorder()->generate($this->_dataRows));
    }
}