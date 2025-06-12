<?php

declare(strict_types=1);

namespace Tests\Unit\Visitor;

use App\Mail\OrderConfirmationMail;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
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

    public function testPlaceOrderWithKiloProduct(): void
    {
        Mail::fake();

        $product = Product::factory()->create([
            'price' => 8,
            'type' => 'kilo'
        ]);

        Stock::factory()->create([
            'product_id' => $product->id,
            'quantity' => 100,
        ]);

        $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 3,
        ]);

        $expectedSubtotal = 24;

        $actualSubtotal = $product->asType()->calculatePrice(3);

        $this->assertEquals($expectedSubtotal, $actualSubtotal);

        $response = $this->post(route('order.place'), [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890',
            'pickup_time' => now()->addHour(),
        ]);

        $response->assertRedirect(route('checkout.form'));
        $response->assertSessionHas('success', 'Bestelling succesvol geplaatst. Er is een e-mail naar u verstuurd met de details van de bestelling.');

        Mail::assertSent(OrderConfirmationMail::class);

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

    public function testPlaceOrderWithPieceProduct(): void
    {
        Mail::fake();

        $product = Product::factory()->create([
            'name' => 'RundBurger',
            'type' => 'piece',
            'price' => 2,
        ]);

        Stock::factory()->create([
            'product_id' => $product->id,
            'quantity' => 100,
        ]);

        $this->withSession([]);

        $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 3,
            'type' => 'piece',
        ]);

        $expectedSubtotal = 6.0;

        $actualSubtotal = $product->asType()->calculatePrice(3);

        $this->assertEquals($expectedSubtotal, $actualSubtotal);

        $response = $this->post(route('order.place'), [
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'phone' => '0123456789',
            'pickup_time' => now()->addHour(),
        ]);

        $response->assertRedirect(route('checkout.form'));
        $response->assertSessionHas('success', 'Bestelling succesvol geplaatst. Er is een e-mail naar u verstuurd met de details van de bestelling.');

        Mail::assertSent(OrderConfirmationMail::class);

        $this->assertEmpty(session('cart'));
    }
}
