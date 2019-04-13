<?php

use Solid\DebitProcessor;

require "vendor/autoload.php";

$validators = [
    new \Solid\validators\ValidateAccountBalance(),
    new \Solid\validators\ValidateUserPermission(),
];

$debitProcessor = new DebitProcessor(
    new \Solid\Biller(),
    new \Solid\UserRepository(),
    $validators
);

try {
    $debitProcessor->processDebit();
} catch (Exception $exception) {
    echo $exception->getMessage() . '🔥', PHP_EOL;
}
