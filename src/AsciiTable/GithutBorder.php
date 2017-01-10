<?php
namespace Mmarica\DisplayTable\AsciiTable;


class GithutBorder extends AbstractBorder
{
    protected $_headerContent = array('|', '|', '|');
    protected $_headerIntersection = array('|', '-', '|', '|');
    protected $_dataContent = array('|', '|', '|');
}