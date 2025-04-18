<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;

class StockManager
{
    public function index(): Collection
    {
        return Stock::all();
    }

    public function getByProductUuid(string $uuid): ?Collection
    {
        $product = Product::where('uuid', $uuid)->first();
        if ($product) {
            return $product->stocks;
        }

        return null;
    }

    public function getById(int $stockId): ?Stock
    {
        return Stock::find($stockId);
    }

    public function create(array $data): Stock
    {
        return Stock::create([
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'date' => $data['date'] ?? now(),
        ]);
    }

    public function update(int $stockId, array $data): ?Stock
    {
        $stock = Stock::find($stockId);

        if ($stock) {
            $stock->update($data);
            return $stock;
        }

        return null;
    }

    public function delete(int $stockId): bool
    {
        $stock = Stock::find($stockId);

        if ($stock) {
            return $stock->delete();
        }

        return false;
    }
}
