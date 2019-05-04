<?php

namespace Solid;

use Exception;
use Solid\Contracts\ValidatorInterface;
use Solid\Contracts\UserRepositoryInterface;

class DebitProcessor
{
    private $biller;
    /**
     * @var JSONUserRepository
     */
    private $userRepository;

    private $input;
    /**
     * @var ValidatorInterface
     */
    private $validators;

    public function __construct(Biller $biller, UserRepositoryInterface $userRepository, array $validators = [])
    {
        $this->biller = $biller;
        $this->userRepository = $userRepository;
        $this->input = new Input();
        $this->validators = $validators;
    }

    /**
     * @throws Exception
     */
    public function processDebit(): void
    {
        $inputs = $this->input->collectInputs();

        $user = $this->userRepository->getUser($inputs->id);

        if (!$user) {
            throw new Exception(sprintf("The user with the ID: %s doesn't exist!", $inputs->id));
        }

        $this->validate($user, $inputs);

        if ($this->biller->bill($user->id, $inputs->amount)) {
            printf("User: %s has been billed: %d ✅ \n", $user->name, $inputs->amount);
        }
    }

    protected function validate($user, $amount)
    {
        foreach ($this->validators as $validator) {
            $validator->validate($user, $amount);
        }
    }
}
