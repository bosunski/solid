<?php

use Solid\Biller;
use Solid\Contracts\ConnectionInterface;
use Solid\Contracts\FileSystem;
use Solid\Contracts\UserRepositoryInterface;
use Solid\Database\DatabaseUserRepository;
use Solid\Database\MySQLConnection;
use Solid\DebitProcessor;
use Solid\FIleHandler;

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

$container = new \Solid\Container\DIContainer;

$container->set(FileSystem::class, FIleHandler::class);
$container->set(UserRepositoryInterface::class, DatabaseUserRepository::class);
$container->set(Biller::class, Biller::class);
$container->set(DebitProcessor::class, DebitProcessor::class);

$container->set(ConnectionInterface::class, function ($container) {
    return MySQLConnection::getConnection();
});

