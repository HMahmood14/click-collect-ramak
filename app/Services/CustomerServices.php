<?php

declare(strict_types=1);

namespace App\Services;

use App\Managers\CustomerManager;
use App\Models\Customer;

class CustomerServices
{
    protected CustomerManager $customerManager;

    public function __construct(CustomerManager $customerManager)
    {
        $this->customerManager = $customerManager;
    }

    public function getOrCreateCustomer(array $data): Customer
    {
        return $this->customerManager->findOrCreate($data);
    }
}
