<?php
namespace Mmarica\DisplayTable\Data;

use Mmarica\DisplayTable\AsciiTable\BorderFactory;
use Mmarica\DisplayTable\AsciiTable\RoundedBorder;
use Mmarica\DisplayTable\AsciiTable\MysqlBorder;
use Mmarica\DisplayTable\AsciiTable\DottedBorder;
use Mmarica\DisplayTable\AsciiTable\CompleteBorder;
use Mmarica\DisplayTable\AsciiTable\BubbleBorder;
use Mmarica\DisplayTable\AsciiTable\GirderBorder;
use Mmarica\DisplayTable\AsciiTable\CompactBorder;
use Mmarica\DisplayTable\AsciiTable\NoBorder;
use PHPUnit_Framework_TestCase;


class BorderFactoryTest extends PHPUnit_Framework_TestCase
{
    public function test_create_InvalidBorderType()
    {
        $this->expectException(\UnexpectedValueException::class);
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

    public function test_create_CompleteBorder()
    {
        $border = BorderFactory::create(BorderFactory::COMPLETE_BORDER, array());
        $this->assertInstanceOf(CompleteBorder::class, $border);
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