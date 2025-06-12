<?php

declare(strict_types=1);

namespace Tests\Unit\Admin\Product;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $productService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productService = \Mockery::mock(ProductServices::class);
        $this->actingAs(Admin::factory()->create(), 'admin');
    }

    public function testCanSeeAllProductsOnIndexPage(): void
    {
        Product::factory()->count(5)->create();

        $response = $this->get(route('product.index'));
        $response->assertStatus(200);
        $response->assertViewIs('product.index');
        $response->assertViewHas('products');
    }

    public function testCanCreateAProduct(): void
    {
        $category = Category::factory()->create();

        $productData = [
            'name' => 'Test Product',
            'description' => 'Dit is een testproduct voor het testen van de productfunctionaliteit.',
            'price' => 100,
            'category_id' => $category->id,
            'type' => 'kilo'
        ];

        $response = $this->post(route('product.store'), $productData);
        $response->assertRedirect(route('product.index'));
        $response->assertSessionHas('success', 'Product succesvol toegevoegd.');

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'Dit is een testproduct voor het testen van de productfunctionaliteit.',
            'price' => 100,
            'category_id' => $category->id,
            'type' => 'kilo'
        ]);
    }

    public function testCanUpdateAProduct(): void
    {
        $product = Product::factory()->create();

        $updatedProductData = [
            'name' => 'Updated product',
            'description' => $product->description,
            'price' => $product->price,
            'category_id' => $product->category_id,
        ];

        $response = $this->put(route('product.update', $product->uuid), $updatedProductData);

        $response->assertRedirect(route('product.index'));
        $response->assertSessionHas('success', 'Product succesvol aangepast.');

        $this->assertDatabaseHas('products', [
            'name' => 'Updated product',
        ]);
    }

    public function testCanDeleteAProduct(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('product.delete', $product->uuid));

        $response->assertRedirect(route('product.index'));
        $response->assertSessionHas('success', 'Product succesvol verwijderd.');

        $this->assertDatabaseMissing('products', [
            'uuid' => $product->uuid,
        ]);
    }
}
