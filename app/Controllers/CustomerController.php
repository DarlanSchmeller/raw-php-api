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

    public function show($customerId): void
    {
        $query = $this->dbConn->prepare('SELECT * FROM customers WHERE id = :id');
        $query->bindParam(':id', $customerId);
        $data = $query->execute();
        $data = $query->fetchAll();

        $this->deliverResponse(200, $data);
    }
}