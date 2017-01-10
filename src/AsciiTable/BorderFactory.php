<?php
namespace Mmarica\DisplayTable\AsciiTable;


/**
 * Border Factory Class
 */
class BorderFactory
{
    // Border styles
    const ROUNDED_BORDER = 'rounded_border';
    const MYSQL_BORDER = 'mysql_border';
    const DOTTED_BORDER = 'dotted_border';
    const COMPLETE_BORDER = 'complete_border';
    const BUBBLE_BORDER = 'bubble_border';
    const GIRDER_BORDER = 'girder_border';
    const COMPACT_BORDER = 'compact_border';
    const NO_BORDER = 'no_border';
    const GITHUB_BORDER = 'github_border';

    /**
     * @param string $borderType    Border type
     * @param array  $columnLengths List of maximum lengths for every column
     * @return AbstractBorder
     * @throws \Exception
     */
    public static function create($borderType, $columnLengths)
    {
        switch ($borderType) {
            case self::ROUNDED_BORDER:
                return new RoundedBorder($columnLengths);

            case self::MYSQL_BORDER:
                return new MysqlBorder($columnLengths);

            case self::DOTTED_BORDER:
                return new DottedBorder($columnLengths);

            case self::GITHUB_BORDER:
                return new GithubBorder($columnLengths);

            case self::COMPLETE_BORDER:
                return new CompleteBorder($columnLengths);

            case self::BUBBLE_BORDER:
                return new BubbleBorder($columnLengths);

            case self::GIRDER_BORDER:
                return new GirderBorder($columnLengths);

            case self::COMPACT_BORDER:
                return new CompactBorder($columnLengths);

            case self::NO_BORDER:
                return new NoBorder($columnLengths);

            default:
                throw new \UnexpectedValueException('Invalid border type: ' . $borderType);
        }
    }
}
