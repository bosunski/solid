<?php

namespace Solid;


class UserRepository
{
    /**
     * @param int $userId
     * @return stdClass|null
     */
    public function getUser(int $userId)
    {
        $userStore = __DIR__ . DIRECTORY_SEPARATOR . "store/users.json";
        $users = json_decode(file_get_contents($userStore));

        foreach ($users as $user) {
            if ($user->id === $userId) return $user;
        }

        return null;
    }
}
