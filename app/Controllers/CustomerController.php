<?php

namespace App\Controllers;

class CustomerController extends Controller
{
    public function index(): void
    {
        $query = $this->dbConn->query('SELECT * FROM customers');
        $data = $query->fetchAll();

        $this->deliverResponse(200, $data);
    }
}