<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Customer;

class CustomerManager
{
    public function findOrCreate(array $data): Customer
    {
        $customer = Customer::where('email', $data['email'])->first();

        if (!$customer) {
            $customer = Customer::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
        }

        return $customer;
    }
}
