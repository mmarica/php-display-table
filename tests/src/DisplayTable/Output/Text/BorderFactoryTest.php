<?php
namespace Tests\DisplayTable\Output\Text;

use Tests\AbstractTest;
use Mmarica\DisplayTable\Output\Text\Border\BubbleBorder;
use Mmarica\DisplayTable\Output\Text\Border\CompactBorder;
use Mmarica\DisplayTable\Output\Text\Border\DifferentiatedBorder;
use Mmarica\DisplayTable\Output\Text\Border\DottedBorder;
use Mmarica\DisplayTable\Output\Text\Border\GirderBorder;
use Mmarica\DisplayTable\Output\Text\Border\MysqlBorder;
use Mmarica\DisplayTable\Output\Text\Border\NoBorder;
use Mmarica\DisplayTable\Output\Text\Border\RoundedBorder;
use Mmarica\DisplayTable\Output\Text\BorderFactory;


class BorderFactoryTest extends AbstractTest
{
    public function test_create_InvalidBorderType()
    {
        $this->setExpectedException(\UnexpectedValueException::class);
        BorderFactory::create('invalid', []);
    }

    public function test_create_RoundedBorder()
    {
        $border = BorderFactory::create(BorderFactory::ROUNDED_BORDER, []);
        $this->assertInstanceOf(RoundedBorder::class, $border);
    }

    public function test_create_MysqlBorder()
    {
        $border = BorderFactory::create(BorderFactory::MYSQL_BORDER, []);
        $this->assertInstanceOf(MysqlBorder::class, $border);
    }

    public function test_create_DottedBorder()
    {
        $border = BorderFactory::create(BorderFactory::DOTTED_BORDER, []);
        $this->assertInstanceOf(DottedBorder::class, $border);
    }

    public function test_create_DifferentiatedBorder()
    {
        $border = BorderFactory::create(BorderFactory::DIFFERENTIATED_BORDER, []);
        $this->assertInstanceOf(DifferentiatedBorder::class, $border);
    }

    public function test_create_BubbleBorder()
    {
        $border = BorderFactory::create(BorderFactory::BUBBLE_BORDER, []);
        $this->assertInstanceOf(BubbleBorder::class, $border);
    }

    public function test_create_GirderBorder()
    {
        $border = BorderFactory::create(BorderFactory::GIRDER_BORDER, []);
        $this->assertInstanceOf(GirderBorder::class, $border);
    }

    public function test_create_CompactBorder()
    {
        $border = BorderFactory::create(BorderFactory::COMPACT_BORDER, []);
        $this->assertInstanceOf(CompactBorder::class, $border);
    }

    public function test_create_NoBorder()
    {
        $border = BorderFactory::create(BorderFactory::NO_BORDER, []);
        $this->assertInstanceOf(NoBorder::class, $border);
    }
}