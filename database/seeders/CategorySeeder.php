<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Kip'],
            ['name' => 'Rund'],
            ['name' => 'Lams'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
