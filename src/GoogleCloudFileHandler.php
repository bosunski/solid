<?php

namespace Solid;

use Solid\Contracts\ConnectibleInterface;
use Solid\Contracts\FileSystem;

class GoogleCloudFileHandler implements FileSystem, ConnectibleInterface
{
    public function getFile(string $path)
    {
        // The implementation that will get file from google cloud
    }

    public function write($path, $buffer)
    {
        //
    }

    public function connect()
    {
    }
}
