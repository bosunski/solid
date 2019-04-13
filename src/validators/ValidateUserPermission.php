<?php

namespace Solid\validators;


use Exception;
use Solid\Contracts\ValidatorInterface;

class ValidateUserPermission implements ValidatorInterface
{
    public function validate($user, $inputs)
    {
        if (!$user->canWithdraw) {
            throw new Exception(sprintf("Your account is not enabled for withdrawal!"));
        }
    }

}
