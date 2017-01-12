<?php
namespace Mmarica\DisplayTable\Output\Text\Border;


/**
 * Github Border Class
 */
class GithubBorder extends AbstractBorder
{
    protected $_headerContent = array('|', '|', '|');
    protected $_headerIntersection = array('|', '-', '|', '|');
    protected $_dataContent = array('|', '|', '|');
}