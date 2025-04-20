<?php

declare(strict_types=1);

namespace App\Services;

use App\Managers\CustomerManager;
use App\Managers\OrderManager;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use mysql_xdevapi\SqlStatementResult;

class OrderServices
{
    protected CustomerManager $customerManager;
    protected OrderManager $orderManager;

    public function __construct(CustomerManager $customerManager, OrderManager $orderManager)
    {
        $this->customerManager = $customerManager;
        $this->orderManager = $orderManager;
    }

    public function getOrCreateCustomer(array $data): Customer
    {
        return $this->customerManager->findOrCreate($data);
    }

    public function createOrder(array $orderData): Order
    {
        $customer = $this->getOrCreateCustomer([
            'name' => $orderData['name'],
            'email' => $orderData['email'],
            'phone' => $orderData['phone'],
        ]);

        $orderData['customer_id'] = $customer->id;

        return $this->orderManager->create($orderData);
    }

    public function updateStatusAndSendReminder(string $uuid): bool
    {
        return $this->orderManager->updateStatusAndSendReminder($uuid);
    }

    public function getAll(): Collection
    {
        return $this->orderManager->getAllOrders();
    }

    public function deleteOrder(string $uuid): bool
    {
        return $this->orderManager->delete($uuid);
    }
}
