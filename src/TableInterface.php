<?php

namespace Mmarica\DisplayTable;

interface TableInterface
{
    public function generate(Table\Data $data);
}