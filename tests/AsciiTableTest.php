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
        $asciiTable = new AsciiTable();
        $result = $asciiTable->generate($this->_data);

        $expected = <<<EOF
.---.-----------.------------------------------.
| # |  Person   |           Hobbies            |
:---+-----------+------------------------------:
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |
'---'-----------'------------------------------'
EOF;
        $this->assertSame($expected, $result);
    }

    public function testNoPadding()
    {
        $asciiTable = new AsciiTable(array(
            AsciiTable::OPT_HORIZONTAL_PADDING => 0
        ));
        $result = $asciiTable->generate($this->_data);

        $expected = <<<EOF
.-.---------.----------------------------.
|#| Person  |          Hobbies           |
:-+---------+----------------------------:
|1|Mihai    |Cycling, Gaming, Programming|
|2|Chewbacca|Growling                    |
|3|Tudor    |Diets                       |
'-'---------'----------------------------'
EOF;
        $this->assertSame($expected, $result);
    }

    public function testPadding()
    {
        $asciiTable = new AsciiTable(array(
            AsciiTable::OPT_HORIZONTAL_PADDING => 2,
            AsciiTable::OPT_VERTICAL_PADDING => 1
        ));
        $result = $asciiTable->generate($this->_data);

        $expected = <<<EOF
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
EOF;
        $this->assertSame($asciiTable->getHorizontalPadding(), 2);
        $this->assertSame($asciiTable->getVerticalPadding(), 1);
        $this->assertSame($expected, $result);
    }

    public function testMysqlBorders()
    {
        $asciiTable = new AsciiTable(array(
            AsciiTable::OPT_BORDERS => AsciiTable::MYSQL_BORDERS
        ));
        $result = $asciiTable->generate($this->_data);

        $expected = <<<EOF
+---+-----------+------------------------------+
| # |  Person   |           Hobbies            |
+---+-----------+------------------------------+
| 1 | Mihai     | Cycling, Gaming, Programming |
| 2 | Chewbacca | Growling                     |
| 3 | Tudor     | Diets                        |
+---+-----------+------------------------------+
EOF;
        $this->assertSame($expected, $result);
        $this->assertSame($asciiTable->getBorders(), AsciiTable::MYSQL_BORDERS);
    }

    public function testDotsBorders()
    {
        $asciiTable = new AsciiTable(array(
            AsciiTable::OPT_BORDERS => AsciiTable::DOTS_BORDERS
        ));
        $result = $asciiTable->generate($this->_data);

        $expected = <<<EOF
................................................
: # :  Person   :           Hobbies            :
:...:...........:..............................:
: 1 : Mihai     : Cycling, Gaming, Programming :
: 2 : Chewbacca : Growling                     :
: 3 : Tudor     : Diets                        :
:...:...........:..............................:
EOF;
        $this->assertSame($expected, $result);
    }
}