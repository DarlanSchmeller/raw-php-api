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
    
    public function create(): void
    {
        // Read raw JSON body from request
        $rawBody = file_get_contents('php://input');

        // Decode the data into array
        $decodedData = json_decode($rawBody, true);
        if (! isset($decodedData['values'])) {
            $this->deliverResponse(400, 'Request format not recognizable');
        }

        // Get the data to create customer
        [$first_name, $last_name, $email, $phone, $status] = $decodedData['values'];

        // Build data to create a new customer
        $sql = 'INSERT INTO customers (first_name, last_name, email, phone, status)
        VALUES (:first_name, :last_name, :email, :phone, :status)';
        $query = $this->dbConn->prepare($sql);

        // Bind customer data to query string
        $query->bindParam(':first_name', $first_name);
        $query->bindParam(':last_name', $last_name);
        $query->bindParam(':email', $email);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':status', $status);

        $result = $query->execute();

        $this->deliverResponse(201, $result);
    }
}