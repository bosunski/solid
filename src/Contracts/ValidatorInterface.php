<?php

namespace Solid\Contracts;

interface ValidatorInterface
{
    public function validate($user, $inputs);
}
