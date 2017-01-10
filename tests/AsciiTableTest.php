<?php

namespace Tests\DisplayTable;

use Mmarica\DisplayTable\DataSource;
use Mmarica\DisplayTable\AsciiTable;
use PHPUnit_Framework_TestCase;

class AsciiTableTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DataSource\Base
     */
    protected $_data;

    protected function setUp()
    {
        parent::setUp();
        $this->_data = new DataSource\FromArray(
            array('#', 'Person', 'Hobbies'),
            array(
                array('1', 'Mihai', 'Cycling, Gaming, Programming'),
                array('2', 'Chewbacca', 'Growling'),
                array('3', 'Tudor', 'Diets'),
            )
        );
    }

    public function testDefaults()
    {
        $result = AsciiTable::create()->generate($this->_data);

        $expected = <<<'EOD'
.---.-----------.------------------------------.
| # |  Person   |           Hobbies            |
:---+-----------+------------------------------:
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |
'---'-----------'------------------------------'

EOD;
        $this->assertSame($expected, $result);
    }

    public function testNoPadding()
    {
        $result = AsciiTable::create()->noPadding()
            ->generate($this->_data);

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

    public function testPadding()
    {
        $asciiTable = AsciiTable::create()
            ->hPadding(2)->vPadding(1);

        $this->assertSame($asciiTable->getHPadding(), 2);
        $this->assertSame($asciiTable->getVPadding(), 1);

        $result = $asciiTable->generate($this->_data);

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

    public function testRoundedBorder()
    {
        $asciiTable = AsciiTable::create()->roundedBorder();
        $result = $asciiTable->generate($this->_data);

        $expected = <<<'EOD'
.---.-----------.------------------------------.
| # |  Person   |           Hobbies            |
:---+-----------+------------------------------:
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |
'---'-----------'------------------------------'

EOD;
        $this->assertSame($expected, $result);
    }

    public function testMysqlBorder()
    {
        $asciiTable = AsciiTable::create()->mysqlBorder();
        $result = $asciiTable->generate($this->_data);

        $expected = <<<'EOD'
+---+-----------+------------------------------+
| # |  Person   |           Hobbies            |
+---+-----------+------------------------------+
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |
+---+-----------+------------------------------+

EOD;
        $this->assertSame($expected, $result);
        $this->assertSame($asciiTable->getBorderType(), AsciiTable::MYSQL_BORDER);
    }

    public function testDottedBorder()
    {
        $expected = <<<'EOD'
................................................
: # :  Person   :           Hobbies            :
:...:...........:..............................:
: 1 : Mihai     : Cycling, Gaming, Programming :
: 2 : Chewbacca : Growling                     :
: 3 : Tudor     : Diets                        :
:...:...........:..............................:

EOD;
        $this->assertSame($expected, AsciiTable::create()->dottedBorder()->generate($this->_data));
    }

    public function testGithubBorder()
    {
        $expected = <<<'EOD'
| # |  Person   |           Hobbies            |
|---|-----------|------------------------------|
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |

EOD;
        $this->assertSame($expected, AsciiTable::create()->githubBorder()->generate($this->_data));
    }

    public function testCompleteBorder()
    {
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
        $this->assertSame($expected, AsciiTable::create()->completeBorder()->generate($this->_data));
    }

    public function testBubbleBorder()
    {
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
        $this->assertSame($expected, AsciiTable::create()->bubbleBorder()->generate($this->_data));
    }

    public function testGirderBorder()
    {
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
        $this->assertSame($expected, AsciiTable::create()->girderBorder()->generate($this->_data));
    }

    public function testCompactBorder()
    {
        $expected = <<<'EOD'
 #   Person              Hobbies            
--------------------------------------------
 1  Mihai      Cycling, Gaming, Programming 
 2  Chewbacca  Growling                     
 3  Tudor      Diets                        

EOD;
        $this->assertSame($expected, AsciiTable::create()->compactBorder()->generate($this->_data));
    }

    public function testNoBorder()
    {
        $expected = <<<'EOD'
 #   Person              Hobbies            
 1  Mihai      Cycling, Gaming, Programming 
 2  Chewbacca  Growling                     
 3  Tudor      Diets                        

EOD;
        $this->assertSame($expected, AsciiTable::create()->noBorder()->generate($this->_data));
    }
}