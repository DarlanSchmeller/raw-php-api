<?php

namespace App\Controllers;

use App\Services\CustomerService;
use Exception;
use PDOException;

class CustomerController extends Controller
{
    protected CustomerService $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService;
    }

    public function index(): void
    {
        $data = $this->customerService->listAllCustomers();
        $this->deliverResponse(200, $data);
    }

    public function show($customerId): void
    {
        $data = $this->customerService->listSingleCustomer($customerId);

        $this->deliverResponse(200, $data);
    }
    
    public function create(): void
    {
        // Read raw JSON body from request
        $rawBody = file_get_contents('php://input');

        // Decode the data into array
        $decodedData = json_decode($rawBody, true);
        if (! is_array($decodedData)) {
            $this->deliverResponse(400, 'Request format not recognizable');
        }

        try {
            $this->customerService->create($decodedData);
            $this->deliverResponse(201, 'Customer created successfuly!');
        } catch (PDOException|Exception $e) {
            $this->deliverResponse(400, 'There has been an error when attempting to create a new customer: ' . $e->getMessage());
        }
    }
}