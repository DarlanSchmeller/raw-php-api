<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use Exception;

class CustomerService
{
    protected CustomerRepository $customerRepository;

    public function __construct()
    {
        $this->customerRepository = new CustomerRepository;
    }

    public function create($data): void
    {
        $this->validateData($data);
        $this->customerRepository->createCustomer($data);

    }
    
    public function validateData($decodedData): void
    {
        $expectedKeys = ['first_name', 'last_name', 'email', 'phone', 'status'];

        // Validate if keys are present
        foreach ($expectedKeys as $expectedKey) {
            if (! in_array($expectedKey, array_keys($decodedData))) {
                throw new Exception("Missing key on request data: " . $expectedKey, 400);
            }

            if (empty($decodedData[$expectedKey])) {
                throw new Exception("Missing data on the following request key: " . $expectedKey, 400);
            }
        }
    }
}