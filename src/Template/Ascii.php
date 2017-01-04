<?php

namespace Mmarica\DisplayTable\Template;

use Mmarica\DisplayTable\TemplateInterface;

class Ascii implements TemplateInterface
{

    public function getOutput($columnNames, $rows)
    {
        $hasHeader = false;
        $colLengths = array();
        $data = array();

        if (count($columnNames)) {
            $hasHeader = true;
            $data[] = array_values($columnNames);

            $index = 0;
            foreach ($columnNames as $value) {
                $colLengths[$index] = strlen($value);
                $index++;
            }
        }

        foreach ($rows as $row) {
            $data[] = array_values($row);

            $index = 0;
            foreach ($row as $value) {
                $colLengths[$index] = isset($colLengths[$index]) ? max($colLengths[$index], strlen($value)) : strlen($value);
                $index++;
            }
        }

        return print_r($data, true);
    }
}