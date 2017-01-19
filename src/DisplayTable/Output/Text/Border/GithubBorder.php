<?php
namespace Mmarica\DisplayTable\Output\Text\Border;


/**
 * Github Border Class
 */
class GithubBorder extends AbstractBorder
{
    protected $_headerContent = ['|', '|', '|'];
    protected $_headerIntersection = ['|', '-', '|', '|'];
    protected $_dataContent = ['|', '|', '|'];
}