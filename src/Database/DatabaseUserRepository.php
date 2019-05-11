<?php

namespace Solid\Database;

use Solid\Contracts\ConnectionInterface;
use Solid\Contracts\UserRepositoryInterface;

class DatabaseUserRepository implements UserRepositoryInterface
{
    /**
     * @var ConnectionInterface
     */
    private $dbConnection;

    public function __construct(ConnectionInterface $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function getUser(int $userId)
    {
        $users = $this->getUsers();

        foreach ($users as $user) {
            if ($user->id === $userId) return $user;
        }

        return null;
    }

    public function saveUser(string $users)
    {
        $sql = sprintf("UPDATE data SET users = '%s'", $users);

        $this->dbConnection->getConnection()->queryDB($sql);

        return true;
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM data";

        $result = $this->dbConnection->getConnection()->queryDB($sql);

        return json_decode($result->fetch()->users);
    }
}
