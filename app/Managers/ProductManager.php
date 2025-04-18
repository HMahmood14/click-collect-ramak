<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductManager
{
    public function index(): Collection
    {
        return Product::all();
    }

    public function getByUuid(string $uuid): ?Product
    {
        return Product::where('uuid', $uuid)->first();
    }

    public function create(array $data): Product
    {
        return Product::create([
        'name' => $data['name'],
        'description' => $data['description'],
        'price' => $data['price'],
        'category_id' => $data['category_id'],
        ]);
    }

    public function update(string $uuid, array $data): ?Product
    {
        $product = Product::where('uuid', $uuid)->first();

        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    public function delete(string $uuid): bool
    {
        $product = Product::where('uuid', $uuid)->first();

        if ($product) {
            return $product->delete();
        }
        return false;
    }
}
