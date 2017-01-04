<?php

namespace Mmarica\DisplayTable;

class AsciiTable implements TableInterface
{

    public function generate(Table\Data $data)
    {
        list($columns, $rows) = $data->get();

        $hasHeader = false;
        $colLengths = array();
        $data = array();

        if (count($columns)) {
            $hasHeader = true;
            $data[] = array_values($columns);

            $index = 0;
            foreach ($columns as $value) {
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