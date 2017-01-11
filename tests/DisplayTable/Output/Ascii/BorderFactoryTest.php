<?php
namespace Tests\DisplayTable\Output\Ascii;

use Mmarica\DisplayTable\Output\Ascii\BorderFactory;
use Mmarica\DisplayTable\Output\Ascii\Border;
use PHPUnit_Framework_TestCase;


class BorderFactoryTest extends PHPUnit_Framework_TestCase
{
    public function test_create_InvalidBorderType()
    {
        $this->setExpectedException(\UnexpectedValueException::class);
        BorderFactory::create('invalid', array());
    }

    public function test_create_RoundedBorder()
    {
        $border = BorderFactory::create(BorderFactory::ROUNDED_BORDER, array());
        $this->assertInstanceOf(Border\RoundedBorder::class, $border);
    }

    public function test_create_MysqlBorder()
    {
        $border = BorderFactory::create(BorderFactory::MYSQL_BORDER, array());
        $this->assertInstanceOf(Border\MysqlBorder::class, $border);
    }

    public function test_create_DottedBorder()
    {
        $border = BorderFactory::create(BorderFactory::DOTTED_BORDER, array());
        $this->assertInstanceOf(Border\DottedBorder::class, $border);
    }

    public function test_create_DifferentiatedBorder()
    {
        $border = BorderFactory::create(BorderFactory::DIFFERENTIATED_BORDER, array());
        $this->assertInstanceOf(Border\DifferentiatedBorder::class, $border);
    }

    public function test_create_BubbleBorder()
    {
        $border = BorderFactory::create(BorderFactory::BUBBLE_BORDER, array());
        $this->assertInstanceOf(Border\BubbleBorder::class, $border);
    }

    public function test_create_GirderBorder()
    {
        $border = BorderFactory::create(BorderFactory::GIRDER_BORDER, array());
        $this->assertInstanceOf(Border\GirderBorder::class, $border);
    }

    public function test_create_CompactBorder()
    {
        $border = BorderFactory::create(BorderFactory::COMPACT_BORDER, array());
        $this->assertInstanceOf(Border\CompactBorder::class, $border);
    }

    public function test_create_NoBorder()
    {
        $border = BorderFactory::create(BorderFactory::NO_BORDER, array());
        $this->assertInstanceOf(Border\NoBorder::class, $border);
    }
}