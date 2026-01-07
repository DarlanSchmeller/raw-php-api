<?php

namespace App\Controllers;

use App\Database\DatabaseConnector;

class CustomerController
{
    protected $dbConn;

    public function __construct()
    {
        $dbConn = new DatabaseConnector;
        $this->dbConn = $dbConn->createDbConnection();
    }

    public function index()
    {
        $query = $this->dbConn->query('SELECT * FROM customers');
        $data = $query->fetchAll();

        echo json_encode($data, 0);
    }
}