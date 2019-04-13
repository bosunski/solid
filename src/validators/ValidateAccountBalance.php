<?php

namespace Solid\validators;


use Exception;
use Solid\Contracts\ValidatorInterface;

class ValidateAccountBalance implements ValidatorInterface
{
    /**
     * @param $user
     * @param $inputs
     * @throws Exception
     */
    public function validate($user, $inputs)
    {
        if ($user->balance < $inputs->amount) {
            throw new Exception(sprintf("Contact your financial institution!"));
        }
    }
}
