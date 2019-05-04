<?php

use Solid\Biller;
use Solid\Contracts\FileSystem;
use Solid\Contracts\UserRepositoryInterface;
use Solid\DebitProcessor;
use Solid\FIleHandler;
use Solid\JSONUserRepository;
use Solid\RedisUserRepository;

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

$container = new \Solid\Container\DIContainer;

$container->set(FileSystem::class, FIleHandler::class);
$container->set(UserRepositoryInterface::class, RedisUserRepository::class);
$container->set(Biller::class, Biller::class);
$container->set(DebitProcessor::class, DebitProcessor::class);

