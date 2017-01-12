<?php
namespace Mmarica\DisplayTable\Output\Text\Border;


/**
 * Bubble Border Class
 */
class BubbleBorder extends AbstractBorder
{
    protected $_headerTop = array(' o8', '=', '(_)', '8o ');
    protected $_headerContent = array('(_)', '(_)', '(_)');
    protected $_headerIntersection = array('(88', '=', '(_)', '88)');
    protected $_headerBottom = array(' o8', '=', '(_)', '8o ');
    protected $_dataTop = array(' o8', '-', '(_)', '8o ');
    protected $_dataContent = array('(_)', '(_)', '(_)');
    protected $_dataIntersection = array('(88', '-', '(_)', '88)');
    protected $_dataBottom = array(' o8', '-', '(_)', '8o ');
}