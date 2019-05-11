<?php

namespace Solid;

use Solid\Contracts\FileSystem;
use stdClass;
use Solid\Contracts\UserRepositoryInterface;

class JSONUserRepository implements UserRepositoryInterface
{
    private $file;

    public function __construct(FileSystem $file)
    {
        $this->file = $file;
    }

    /**
     * @param int $userId
     * @return stdClass|null
     */
    public function getUser(int $userId)
    {
        $userStore = __DIR__ . DIRECTORY_SEPARATOR . "store/users.json";
        $users = json_decode($this->file->getFile($userStore));

        foreach ($users as $user) {
            if ($user->id === $userId) return $user;
        }

        return null;
    }

    public function saveUser(string $users)
    {
        $userStore = __DIR__ . DIRECTORY_SEPARATOR . "store/users.json";
        $this->file->write($userStore, $users);
    }
}
