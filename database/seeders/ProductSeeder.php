<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    private $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 6; $i++) {
                Product::create([
                    'uuid' => Str::uuid(),
                    'name' => "{$category->name} Product {$i}",
                    'description' => "Dit is een kort beschrijving van een {$category->name} product {$i}.",
                    'price' => $this->generateRandomPrice($category->name),
                    'category_id' => $category->id,
                ]);
            }
        }
    }

    private function generateRandomPrice(string $category): float
    {
        $prices = [
            'Kip' => [5.00, 10.00],
            'Rund' => [10.00, 20.00],
            'Lams' => [15.00, 25.00],
        ];

        return $this->faker->randomFloat(2, $prices[$category][0], $prices[$category][1]);
    }
}
