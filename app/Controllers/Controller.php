<?php

namespace App\Controllers;

use Database\DatabaseConnector;

class Controller {
    protected $dbConn;

    public function __construct()
    {
        $dbConn = new DatabaseConnector;
        $this->dbConn = $dbConn->createDbConnection();
    }

    protected function deliverResponse($responseCode, $data = null): void
    {
        http_response_code($responseCode);

        exit(json_encode($data, 0));
    }
}