<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;

// Loads env variables into $_ENV superglobal
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
