<?php

require 'vendor/autoload.php';
use Dotenv\Dotenv;
use App\Database\DatabaseConnector;

// Loads env variables into $_ENV superglobal
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create PDO DB connection
$dbConn = new DatabaseConnector;
$dbConn = $dbConn->createDbConnection();
