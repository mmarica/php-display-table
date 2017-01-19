<?php
namespace Mmarica\DisplayTable\Output\Text\Border;


/**
 * Dotted Border Class
 */
class DottedBorder extends AbstractBorder
{
    protected $_headerTop = ['.', '.', '.', '.'];
    protected $_headerContent = [':', ':', ':'];
    protected $_headerIntersection = [':', '.', ':', ':'];
    protected $_headerBottom = [':', '.', ':', ':'];
    protected $_dataTop = ['.', '.', '.', '.'];
    protected $_dataContent = [':', ':', ':'];
    protected $_dataBottom = [':', '.', ':', ':'];
}