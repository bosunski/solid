<?php

use Solid\DebitProcessor;
use Solid\FIleHandler;

require "vendor/autoload.php";

$validators = [
    new \Solid\validators\ValidateAccountBalance(),
    new \Solid\validators\ValidateUserPermission(),
];

$debitProcessor = new DebitProcessor(
    new \Solid\Biller(),
    new \Solid\JSONUserRepository(new FIleHandler()),
    $validators
);

try {
    $debitProcessor->processDebit();
} catch (Exception $exception) {
    echo $exception->getMessage() . '🔥', PHP_EOL;
}
