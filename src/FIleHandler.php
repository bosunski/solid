<?php

namespace Solid;

use Solid\Contracts\FileSystem;

class FIleHandler implements FileSystem
{
    public function getFile(string $path)
    {
        return file_get_contents($path);
    }

    public function write($path, $buffer)
    {
        return  file_put_contents($path, $buffer);
    }
}
