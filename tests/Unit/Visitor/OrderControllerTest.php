<?php

declare(strict_types=1);

namespace Tests\Unit\Visitor;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShowCheckoutForm(): void
    {
        Product::factory()->create();
        $product = Product::first();

        $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $response = $this->get(route('checkout.form'));

        $response->assertStatus(200);
        $response->assertViewIs('visitor.checkout');
        $response->assertViewHas('cartItems');
        $response->assertViewHas('total');
    }

    public function testPlaceOrderWithValidData(): void
    {
        $product = Product::factory()->create();

        Stock::factory()->create([
            'product_id' => $product->id,
            'quantity' => 100,
        ]);

        $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $response = $this->post(route('order.place'), [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890',
            'pickup_time' => now()->addHour(),
        ]);

        $response->assertRedirect(route('order.confirmation'));
        $response->assertSessionHas('success', 'Bestelling succesvol geplaatst.');

        $this->assertEmpty(Session::get('cart'));
    }

    public function testCantPlaceOrderWithInvalidData(): void
    {
        $response = $this->post(route('order.place'), [
            'name' => '',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890',
            'pickup_time' => now()->addHour(),
        ]);

        $response->assertSessionHasErrors('name');
        $response->assertStatus(302);
    }
}
