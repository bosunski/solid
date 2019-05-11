<?php

namespace Solid\Contracts;

interface ConnectionInterface
{
    public static function getConnection(): QueryInterface;
}
