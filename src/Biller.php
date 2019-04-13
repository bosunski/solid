<?php

namespace Solid;


class Biller
{
    /**
     * Deducts an amount from User balance
     *
     * @param int $userId
     * @param int $amount
     * @return bool
     */
    public function bill(int $userId, int $amount): bool
    {
        $userStore = __DIR__ . DIRECTORY_SEPARATOR . "store/users.json";
        $users = json_decode(file_get_contents($userStore));

        // Find User
        foreach ($users as $key => $user) {
            if ($user->id === $userId) {
                $users[$key]->balance = $users[$key]->balance - $amount;
            }
        }

        return file_put_contents(
            $userStore,
            json_encode($users, JSON_PRETTY_PRINT)
        ) ? true : false;
    }
}
