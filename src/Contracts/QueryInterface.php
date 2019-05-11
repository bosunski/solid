<?php

namespace Solid\Contracts;

use PDO;

interface QueryInterface
{
    public function queryDB($sql, $mode = PDO::FETCH_ASSOC);
    public function exec($sql);
}
