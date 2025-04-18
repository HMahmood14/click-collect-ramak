<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'customer_id' => Customer::factory(),
            'total_price' => $this->faker->randomFloat(2, 10, 100),
            'pickup_time' => $this->faker->dateTimeBetween('now', '+3 days'),
            'status' => 'pending',
        ];
    }
}
