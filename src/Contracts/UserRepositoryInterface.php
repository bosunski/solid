<?php

namespace Solid\Contracts;

interface UserRepositoryInterface
{
    public function getUser(int $userId);

    public function saveUsers(string $users);
}
