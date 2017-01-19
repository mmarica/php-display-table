<?php
namespace Mmarica\DisplayTable\Output\Text\Border;


/**
 * Mysql Border Class
 */
class MysqlBorder extends AbstractBorder
{
    protected $_headerTop = ['+', '-', '+', '+'];
    protected $_headerContent = ['|', '|', '|'];
    protected $_headerIntersection = ['+', '-', '+', '+'];
    protected $_headerBottom = ['+', '-', '+', '+'];
    protected $_dataTop = ['+', '-', '+', '+'];
    protected $_dataContent = ['|', '|', '|'];
    protected $_dataBottom = ['+', '-', '+', '+'];
}