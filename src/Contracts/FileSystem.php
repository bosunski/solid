<?php

namespace Solid\Contracts;

interface FileSystem
{
    public function getFile(string $path);

    public function write($path, $buffer);
}
