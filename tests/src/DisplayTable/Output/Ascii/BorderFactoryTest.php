<?php
namespace Tests\DisplayTable\Output\Ascii;

use Tests\AbstractTest;
use Mmarica\DisplayTable\Output\Ascii\Border\BubbleBorder;
use Mmarica\DisplayTable\Output\Ascii\Border\CompactBorder;
use Mmarica\DisplayTable\Output\Ascii\Border\DifferentiatedBorder;
use Mmarica\DisplayTable\Output\Ascii\Border\DottedBorder;
use Mmarica\DisplayTable\Output\Ascii\Border\GirderBorder;
use Mmarica\DisplayTable\Output\Ascii\Border\MysqlBorder;
use Mmarica\DisplayTable\Output\Ascii\Border\NoBorder;
use Mmarica\DisplayTable\Output\Ascii\Border\RoundedBorder;
use Mmarica\DisplayTable\Output\Ascii\BorderFactory;


class BorderFactoryTest extends AbstractTest
{
    public function test_create_InvalidBorderType()
    {
        $this->setExpectedException(\UnexpectedValueException::class);
        BorderFactory::create('invalid', array());
    }

    public function test_create_RoundedBorder()
    {
        $border = BorderFactory::create(BorderFactory::ROUNDED_BORDER, array());
        $this->assertInstanceOf(RoundedBorder::class, $border);
    }

    public function test_create_MysqlBorder()
    {
        $border = BorderFactory::create(BorderFactory::MYSQL_BORDER, array());
        $this->assertInstanceOf(MysqlBorder::class, $border);
    }

    public function test_create_DottedBorder()
    {
        $border = BorderFactory::create(BorderFactory::DOTTED_BORDER, array());
        $this->assertInstanceOf(DottedBorder::class, $border);
    }

    public function test_create_DifferentiatedBorder()
    {
        $border = BorderFactory::create(BorderFactory::DIFFERENTIATED_BORDER, array());
        $this->assertInstanceOf(DifferentiatedBorder::class, $border);
    }

    public function test_create_BubbleBorder()
    {
        $border = BorderFactory::create(BorderFactory::BUBBLE_BORDER, array());
        $this->assertInstanceOf(BubbleBorder::class, $border);
    }

    public function test_create_GirderBorder()
    {
        $border = BorderFactory::create(BorderFactory::GIRDER_BORDER, array());
        $this->assertInstanceOf(GirderBorder::class, $border);
    }

    public function test_create_CompactBorder()
    {
        $border = BorderFactory::create(BorderFactory::COMPACT_BORDER, array());
        $this->assertInstanceOf(CompactBorder::class, $border);
    }

    public function test_create_NoBorder()
    {
        $border = BorderFactory::create(BorderFactory::NO_BORDER, array());
        $this->assertInstanceOf(NoBorder::class, $border);
    }
}