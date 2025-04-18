<?php

declare(strict_types=1);

namespace App\Services;

use App\Managers\ProductManager;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductServices
{
    protected $productManager;

    public function __construct(ProductManager $productManager)
    {
        $this->productManager = $productManager;
    }

    public function getAll(): Collection
    {
        return $this->productManager->index();
    }

    public function getProductByUuid(string $uuid): ?Product
    {
        return $this->productManager->getByUuid($uuid);
    }

    public function createProduct(array $data): Product
    {
        return $this->productManager->create($data);
    }

    public function updateProduct(string $uuid, array $data): ?Product
    {
        return $this->productManager->update($uuid, $data);
    }

    public function deleteProduct(string $uuid): bool
    {
        return $this->productManager->delete($uuid);
    }
}
