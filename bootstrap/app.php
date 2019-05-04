<?php

use Solid\Biller;
use Solid\Contracts\FileSystem;
use Solid\Contracts\UserRepositoryInterface;
use Solid\DebitProcessor;
use Solid\DIContainer;
use Solid\FIleHandler;
use Solid\JSONUserRepository;

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

$container = new DIContainer();

$container->set(UserRepositoryInterface::class, JSONUserRepository::class);
$container->set(Biller::class, Biller::class);
$container->set(FileSystem::class, FIleHandler::class);
$container->set(DebitProcessor::class, DebitProcessor::class);
