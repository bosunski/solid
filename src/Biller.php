<?php

namespace Solid;

use Solid\Contracts\UserRepositoryInterface;

class Biller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Deducts an amount from User balance
     *
     * @param int $userId
     * @param int $amount
     * @return bool
     */
    public function bill(int $userId, int $amount): bool
    {
        $users = $this->userRepository->getUsers();

        // Find User
        foreach ($users as $key => $user) {
            if ($user->id === $userId) {
                $users[$key]->balance = $users[$key]->balance - $amount;
            }
        }

        $this->userRepository->saveUser(json_encode($users, JSON_PRETTY_PRINT));

        return true;
    }
}
