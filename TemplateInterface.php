<?php

namespace Mmarica\DisplayTable;

interface TemplateInterface
{
    public function getOutput($columnNames, $rows);
}