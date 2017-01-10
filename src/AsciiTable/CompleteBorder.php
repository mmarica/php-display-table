<?php
namespace Mmarica\DisplayTable\AsciiTable;


/**
 * Complete Border Class
 */
class CompleteBorder extends AbstractBorder
{
    protected $_headerTop = array('+', '=', '+', '+');
    protected $_headerContent = array('|', '|', '|');
    protected $_headerIntersection = array('+', '=', '+', '+');
    protected $_headerBottom = array('+', '-', '+', '+');
    protected $_dataTop = array('+', '-', '+', '+');
    protected $_dataContent = array('|', '|', '|');
    protected $_dataIntersection = array('+', '-', '+', '+');
    protected $_dataBottom = array('+', '-', '+', '+');
}