<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'uuid' => (string) Str::uuid(),
            'name' => $this->faker->word(),
            'description' => $this->faker->text(200),
            'price' => $this->faker->randomFloat(2, 1, 100) * 100,
            'category_id' => Category::factory(),
            'type' => 'kilo',
        ];
    }
}
