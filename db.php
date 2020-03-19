<?php

use Solid\DBConnection;

require "bootstrap/app.php";

$conn = $container->get(DBConnection::class);
$conn2 = $container->get(DBConnection::class);
$conn3 = $container->get(DBConnection::class);

var_dump($conn === $conn3);
