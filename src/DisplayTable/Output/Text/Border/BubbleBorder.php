<?php
namespace Mmarica\DisplayTable\Output\Text\Border;


/**
 * Bubble Border Class
 */
class BubbleBorder extends AbstractBorder
{
    protected $_headerTop = [' o8', '=', '(_)', '8o '];
    protected $_headerContent = ['(_)', '(_)', '(_)'];
    protected $_headerIntersection = ['(88', '=', '(_)', '88)'];
    protected $_headerBottom = [' o8', '=', '(_)', '8o '];
    protected $_dataTop = [' o8', '-', '(_)', '8o '];
    protected $_dataContent = ['(_)', '(_)', '(_)'];
    protected $_dataIntersection = ['(88', '-', '(_)', '88)'];
    protected $_dataBottom = [' o8', '-', '(_)', '8o '];
}