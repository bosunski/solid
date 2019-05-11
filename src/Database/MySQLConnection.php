<?php

namespace Solid\Database;

use PDO;
use Solid\Contracts\ConnectionInterface;
use Solid\Contracts\QueryInterface;

class MySQLConnection extends PDO implements ConnectionInterface, QueryInterface
{
    protected static $instance = null;

    private function __construct()
    {
        [
            'dsn' => $dsn,
            'username' => $username,
            'password' => $password
        ] = $this->getConnectionParameters();

        parent::__construct($dsn, $username, $password, $options = []);
    }

    protected function __clone()
    {
    }

    public static function getConnection(): QueryInterface
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }

        return new static;
    }

    protected function getConnectionParameters()
    {
        return [
            'dsn'       => 'mysql:dbname=solid;host=localhost',
            'username'  => 'root',
            'password'  => '',
        ];
    }

    public function queryDB($sql, $mode = PDO::FETCH_OBJ)
    {
        return $this->query($sql, $mode);
    }
}
