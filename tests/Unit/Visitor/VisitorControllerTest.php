<?php

declare(strict_types=1);

namespace Tests\Unit\Visitor;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
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

    public function testVisitorCanAddProductToCart()
    {
        $product = Product::factory()->create();

        $this->withSession([]);

        $response = $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $cart = session('cart');
        $this->assertNotNull($cart);
        $this->assertCount(1, $cart);
        $this->assertArrayHasKey($product->uuid, $cart);
        $this->assertEquals($product->id, $cart[$product->uuid]['product_id']);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Product toegevoegd aan winkelmandje.');
    }

    public function testCustomerCanRemoveSpecificProductFromCart()
    {
        Product::factory()->count(4)->create();

        $products = Product::all();
        $productToRemove = $products->first();

        foreach ($products as $product) {
            $this->post(route('cart.add'), [
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        $uuidToRemove = $productToRemove->uuid;

        $cart = Session::get('cart');
        $this->assertNotEmpty($cart);
        $this->assertCount(4, $cart);

        $response = $this->delete(route('cart.remove', ['uuid' => $uuidToRemove]));

        $cart = Session::get('cart');
        $this->assertCount(3, $cart);
        $this->assertArrayNotHasKey($uuidToRemove, $cart);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Product verwijderd uit winkelmandje.');
    }

    public function testCustomerCanClearCart()
    {
        Product::factory()->count(4)->create();

        $products = Product::all();

        foreach ($products as $product) {
            $this->post(route('cart.add'), [
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        $cart = Session::get('cart');
        $this->assertNotEmpty($cart);
        $this->assertCount(4, $cart);

        $response = $this->post(route('cart.clear'));

        $cart = Session::get('cart');
        $this->assertEmpty($cart);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Winkelmandje geleegd.');
    }
}
