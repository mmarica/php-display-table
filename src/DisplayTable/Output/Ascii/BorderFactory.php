<?php
namespace Mmarica\DisplayTable\Output\Ascii;

use Mmarica\DisplayTable\Output\Ascii\Border;


/**
 * Border Factory Class
 */
class BorderFactory
{
    // Border styles
    const ROUNDED_BORDER = 'rounded_border';
    const MYSQL_BORDER = 'mysql_border';
    const DOTTED_BORDER = 'dotted_border';
    const DIFFERENTIATED_BORDER = 'differentiated_border';
    const BUBBLE_BORDER = 'bubble_border';
    const GIRDER_BORDER = 'girder_border';
    const COMPACT_BORDER = 'compact_border';
    const NO_BORDER = 'no_border';
    const GITHUB_BORDER = 'github_border';

    /**
     * @param string $borderType    Border type
     * @param array  $columnLengths List of maximum lengths for every column
     * @return Border\AbstractBorder
     * @throws \Exception
     */
    public static function create($borderType, $columnLengths)
    {
        switch ($borderType) {
            case self::ROUNDED_BORDER:
                return new Border\Rounded($columnLengths);

            case self::MYSQL_BORDER:
                return new Border\Mysql($columnLengths);

            case self::DOTTED_BORDER:
                return new Border\Dotted($columnLengths);

            case self::GITHUB_BORDER:
                return new Border\Github($columnLengths);

            case self::DIFFERENTIATED_BORDER:
                return new Border\Differentiated($columnLengths);

            case self::BUBBLE_BORDER:
                return new Border\Bubble($columnLengths);

            case self::GIRDER_BORDER:
                return new Border\Girder($columnLengths);

            case self::COMPACT_BORDER:
                return new Border\Compact($columnLengths);

            case self::NO_BORDER:
                return new Border\None($columnLengths);

            default:
                throw new \UnexpectedValueException('Invalid border type: ' . $borderType);
        }
    }
}
