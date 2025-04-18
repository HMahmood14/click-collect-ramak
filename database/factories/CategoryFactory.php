<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 1000),
            'uuid' => (string) Str::uuid(),
            'name' => $this->faker->name(),
        ];
    }
}
