<?php

namespace Solid\Contracts;

interface UserRepositoryInterface
{
    public function getUser(int $userId);

    public function saveUser(string $users);

    public function getUsers();
}
