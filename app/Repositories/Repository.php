<?php

namespace App\Repositories;

use Database\DatabaseConnector;

class Repository {
    protected $dbConn;

    public function __construct()
    {
        $dbConn = new DatabaseConnector;
        $this->dbConn = $dbConn->createDbConnection();
    }
}