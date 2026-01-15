<?php

require 'vendor/autoload.php';

use Src\EnvLoader;

// Loads env variables into $_ENV superglobal
$envLoader = new EnvLoader(__DIR__.'/.env');
$envLoader->load();

header('Content-Type: application/json; charset=utf-8');