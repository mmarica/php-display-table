<?php

namespace Mmarica\DisplayTable;

interface TableInterface
{
    /**
     * Generate the table output
     *
     * @param DataSource\Base $data
     * @return string
     */
    public function generate(DataSource\Base $data);
}