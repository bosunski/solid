<?php

use Solid\Biller;
use Solid\Contracts\FileSystem;
use Solid\Contracts\UserRepositoryInterface;
use Solid\DBConnection;
use Solid\DebitProcessor;
use Solid\FIleHandler;
use Solid\RedisUserRepository;

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

$container = new \Solid\Container\DIContainer;

$container->set(FileSystem::class, FIleHandler::class);
$container->set(UserRepositoryInterface::class, \Solid\DBUserRepository::class);
$container->set(Biller::class, Biller::class);
$container->set(DebitProcessor::class, DebitProcessor::class);
$container->singleton(DBConnection::class, DBConnection::class);


