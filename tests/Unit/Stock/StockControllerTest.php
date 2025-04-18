<?php

declare(strict_types=1);

namespace Tests\Unit\Admin\Stock;

use App\Models\Admin;
use App\Models\Product;
use App\Models\Stock;
use App\Services\ProductServices;
use App\Services\StockServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $stockServices;
    protected $productServices;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stockServices = \Mockery::mock(StockServices::class);
        $this->productServices = \Mockery::mock(ProductServices::class);
        $this->actingAs(Admin::factory()->create(), 'admin');
    }

    public function testCanSeeAllStocksOnIndexPage(): void
    {
        Stock::factory()->count(5)->create();

        $response = $this->get(route('stock.index'));
        $response->assertStatus(200);
        $response->assertViewIs('stock.index');
        $response->assertViewHas('stocks');
    }

    public function testCanCreateAStock(): void
    {
        $product = Product::factory()->create();

        $stockData = [
            'product_id' => $product->id,
            'quantity' => 10,
            'date' => now()->toDateString(),
        ];

        $response = $this->post(route('stock.store'), $stockData);

        $response->assertRedirect(route('stock.index'));
        $response->assertSessionHas('success', 'Voorraad succesvol toegevoegd.');

        $this->assertDatabaseHas('stocks', [
            'product_id' => $product->id,
            'quantity' => 10,
        ]);
    }

    public function testCanUpdateAStock(): void
    {
        $stock = Stock::factory()->create();

        $updatedStockData = [
            'product_id' => $stock->product_id,
            'quantity' => 20,
            'date' => now()->toDateString(),
        ];

        $response = $this->put(route('stock.update', $stock->id), $updatedStockData);

        $response->assertRedirect(route('stock.index'));
        $response->assertSessionHas('success', 'Voorraad succesvol bijgewerkt.');

        $this->assertDatabaseHas('stocks', [
            'quantity' => 20,
        ]);
    }

    public function testCanDeleteAStock(): void
    {
        $stock = Stock::factory()->create();

        $response = $this->delete(route('stock.delete', $stock->id));

        $response->assertRedirect(route('stock.index'));
        $response->assertSessionHas('success', 'Voorraad succesvol verwijderd.');

        $this->assertDatabaseMissing('stocks', [
            'id' => $stock->id,
        ]);
    }
}
