<?php

namespace Mmarica\DisplayTable;

interface TableInterface
{
    public function generate(DataSource\Base $data);
}