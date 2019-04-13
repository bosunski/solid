<?php

use Solid\DebitProcessor;

require "vendor/autoload.php";

$debitProcessor = new DebitProcessor();

try {
    $debitProcessor->processDebit();
} catch (Exception $exception) {
    echo $exception->getMessage() . '🔥', PHP_EOL;
}
