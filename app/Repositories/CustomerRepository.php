<?php

namespace App\Repositories;

class CustomerRepository extends Repository {
    public function getAllCustomers(): array
    {
        $query = $this->dbConn->query('SELECT * FROM customers');

        return $query->fetchAll();
    }

    public function getCustomer($customerId): array
    {
        $query = $this->dbConn->prepare('SELECT * FROM customers WHERE id = :id');
        $query->bindParam(':id', $customerId);
        $query->execute();

        return $query->fetchAll();
    }

    public function createCustomer(array $data): bool
    {
        // Build data to create a new customer
        $sql = 'INSERT INTO customers (first_name, last_name, email, phone, status)
        VALUES (:first_name, :last_name, :email, :phone, :status)';
        $query = $this->dbConn->prepare($sql);

        // Bind customer data to query string
        $query->bindParam(':first_name', $data['first_name']);
        $query->bindParam(':last_name', $data['last_name']);
        $query->bindParam(':email', $data['email']);
        $query->bindParam(':phone', $data['phone']);
        $query->bindParam(':status', $data['status']);

        return $query->execute();
    }
}