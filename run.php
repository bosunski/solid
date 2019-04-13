<?php

use Solid\Biller;
use Solid\DebitProcessor;

require "vendor/autoload.php";

$debitProcessor = new DebitProcessor(new Biller());

try {
    $debitProcessor->processDebit();
} catch (Exception $exception) {
    echo $exception->getMessage() . '🔥', PHP_EOL;
}
