<?php

namespace Solid;

use Predis\Client;
use Solid\Contracts\ConnectibleInterface;
use Solid\Contracts\UserRepositoryInterface;

class RedisUserRepository implements UserRepositoryInterface, ConnectibleInterface
{
    private $client;

    public function __construct()
    {
        $this->connect();
    }

    public function getUser(int $userId)
    {
        $users = json_decode($this->client->get('users'));

        foreach ($users as $user) {
            if ($user->id === $userId) return $user;
        }

        return null;
    }

    public function saveUsers(string $users)
    {
        $this->client->set('users', $users);

        return true;
    }

    public function connect()
    {
        $this->client = new Client("tcp://127.0.0.1:6379");
    }
}
