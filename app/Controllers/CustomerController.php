<?php

namespace App\Controllers;

use Exception;
use PDOException;

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
    
    public function create(): void
    {
        // Read raw JSON body from request
        $rawBody = file_get_contents('php://input');

        // Decode the data into array
        $decodedData = json_decode($rawBody, true);
        if (! isset($decodedData)) {
            $this->deliverResponse(400, 'Request format not recognizable');
        }

        $expectedKeys = ['first_name', 'last_name', 'email', 'phone', 'status'];

        // Validate if keys are present
        foreach ($expectedKeys as $expectedKey) {
            if (! in_array($expectedKey, array_keys($decodedData))) {
                $this->deliverResponse(400, 'Request format not recognizable');
            }

            if (empty($decodedData[$expectedKey])) {
                $this->deliverResponse(400, 'The data for the following key is missing: ' . $expectedKey);
            }
        }

        // Build data to create a new customer
        $sql = 'INSERT INTO customers (first_name, last_name, email, phone, status)
        VALUES (:first_name, :last_name, :email, :phone, :status)';
        $query = $this->dbConn->prepare($sql);

        // Bind customer data to query string
        $query->bindParam(':first_name', $decodedData['first_name']);
        $query->bindParam(':last_name', $decodedData['last_name']);
        $query->bindParam(':email', $decodedData['email']);
        $query->bindParam(':phone', $decodedData['phone']);
        $query->bindParam(':status', $decodedData['status']);

        $result = $query->execute();

        $this->deliverResponse(201, $result);
    }
}