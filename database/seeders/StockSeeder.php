<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            Stock::create([
                'uuid' => Str::uuid(),
                'product_id' => $product->id,
                'quantity' => 50,
                'date' => now(),
            ]);
        }
    }
}
