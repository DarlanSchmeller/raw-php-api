<?php

namespace App\Database;

use PDO;
use PDOException;
use Exception;

class DatabaseConnector
{
    private $dbHost;
    private $dbPort;
    private $dbName;
    private $dbUser;
    private $dbPassword;

    public function __construct()
    {
        $this->dbHost = $_ENV['DB_HOST'];
        $this->dbPort = $_ENV['DB_PORT'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->dbUser = $_ENV['DB_USER'];
        $this->dbPassword = $_ENV['DB_PASSWORD'];
    }

    public function createDbConnection(): PDO
    {
        try {
            $dsn = "mysql:host=$this->dbHost;dbname=$this->dbName;charset=utf8mb4";
            $dbConn = new PDO(
                $dsn,
                $this->dbUser,
                $this->dbPassword,
            );
            $dbConn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
            return $dbConn;
        } catch (PDOException $e) {
            throw new Exception('Error connecting to the database: ' . $e->getMessage());
        }
    }
}
