<?php

declare(strict_types=1);

namespace Tests\Unit\Visitor;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisitorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testVisitorCanSeeCategoriesOnHomePage(): void
    {
        $categories = Category::factory()->count(3)->create();

        $response = $this->get(route('home'));

        $response->assertStatus(200);

        foreach ($categories as $category) {
            $response->assertSee($category->name);
        }
    }

    public function testVisitorCanSeeProductsByCategory(): void
    {
        $category = Category::factory()->create();

        $products = Product::factory()->count(3)->create([
            'category_id' => $category->id,
        ]);

        $response = $this->get(route('products.category', ['category' => $category->uuid]));

        $response->assertStatus(200);

        $response->assertSee($category->name);

        foreach ($products as $product) {
            $response->assertSee($product->name);
            $response->assertSee($product->description);
            $response->assertSee(number_format($product->price, 2));
        }
    }
}
