<?php

declare(strict_types=1);

namespace App\Services;

use App\Managers\ProductManager;
use App\Managers\StockManager;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;

class StockServices
{
    protected StockManager $stockManager;
    protected ProductManager $productManager;

    public function __construct(StockManager $stockManager, ProductManager $productManager)
    {
        $this->stockManager = $stockManager;
        $this->productManager = $productManager;
    }

    public function getAll(): Collection
    {
        return $this->stockManager->index();
    }

    public function getByProductUuid(string $uuid): ?Collection
    {
        return $this->stockManager->getByProductUuid($uuid);
    }

    public function getById(int $stockId): ?Stock
    {
        return $this->stockManager->getById($stockId);
    }

    public function create(array $data): Stock
    {
        return $this->stockManager->create($data);
    }

    public function update(int $stockId, array $data): ?Stock
    {
        return $this->stockManager->update($stockId, $data);
    }

    public function delete(int $stockId): bool
    {
        return $this->stockManager->delete($stockId);
    }
}
