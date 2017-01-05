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
        $result = AsciiTable::create()->noPadding()
            ->generate($this->_data);

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
        $asciiTable = AsciiTable::create()
            ->hPadding(2)->vPadding(1);

        $this->assertSame($asciiTable->getHPadding(), 2);
        $this->assertSame($asciiTable->getVPadding(), 1);

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
        $this->assertSame($expected, $result);
    }

    public function testMysqlBorders()
    {
        $asciiTable = AsciiTable::create()->mysqlBorder();
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
        $this->assertSame($asciiTable->getBorder(), AsciiTable::MYSQL_BORDER);
    }

    public function testDotsBorders()
    {
        $expected = <<<EOF
................................................
: # :  Person   :           Hobbies            :
:...:...........:..............................:
: 1 : Mihai     : Cycling, Gaming, Programming :
: 2 : Chewbacca : Growling                     :
: 3 : Tudor     : Diets                        :
:...:...........:..............................:
EOF;
        $this->assertSame($expected, AsciiTable::create()->dottedBorder()->generate($this->_data));
    }
}