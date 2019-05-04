<?php

use Solid\DebitProcessor;

require "bootstrap/app.php";

$validators = [
    new \Solid\validators\ValidateAccountBalance(),
    new \Solid\validators\ValidateUserPermission(),
];

$debitProcessor = $container->get(DebitProcessor::class, ['validators' => $validators]);

try {
    $debitProcessor->processDebit();
} catch (Exception $exception) {
    echo $exception->getMessage() . '🔥', PHP_EOL;
}
