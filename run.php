<?php

use Solid\DebitProcessor;
use Solid\validators\ValidateAccountBalance;
use Solid\validators\ValidateUserPermission;

require "bootstrap/app.php";

$validators = [
    new ValidateAccountBalance(),
    new ValidateUserPermission(),
];

$debitProcessor = $container->get(DebitProcessor::class, ['validators' => $validators]);

try {
    $debitProcessor->processDebit();
} catch (Exception $exception) {
    echo $exception->getMessage() . '🔥', PHP_EOL;
}
