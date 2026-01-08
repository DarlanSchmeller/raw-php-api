<?php

namespace App\Controllers;

use App\Database\DatabaseConnector;

class Controller {
    protected $dbConn;

    public function __construct()
    {
        $dbConn = new DatabaseConnector;
        $this->dbConn = $dbConn->createDbConnection();
    }

    protected function deliverResponse($responseCode, $data = null): void
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($responseCode);

        exit(json_encode($data, 0));
    }
}