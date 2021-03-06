<?php
namespace Mmarica\DisplayTable\Output\Text\Border;


/**
 * Differentiated Border Class
 */
class DifferentiatedBorder extends AbstractBorder
{
    protected $_headerTop = ['+', '=', '+', '+'];
    protected $_headerContent = ['|', '|', '|'];
    protected $_headerIntersection = ['+', '=', '+', '+'];
    protected $_headerBottom = ['+', '=', '+', '+'];
    protected $_dataTop = ['+', '-', '+', '+'];
    protected $_dataContent = ['|', '|', '|'];
    protected $_dataIntersection = ['+', '-', '+', '+'];
    protected $_dataBottom = ['+', '-', '+', '+'];
}