<?php

declare(strict_types=1);

namespace Tests\Unit\Admin;

use App\Mail\OrderReminderMail;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminOrderTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanSeeOrders()
    {
        $this->actingAs(Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]), 'admin');

        $customer = Customer::factory()->create();
        $order1 = Order::factory()->create(['customer_id' => $customer->id]);
        $order2 = Order::factory()->create(['customer_id' => $customer->id]);

        $response = $this->get(route('order.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.orders');
        $response->assertViewHas('orders');
        $response->assertSee($order1->id);
        $response->assertSee($order2->id);
        $response->assertSee($customer->name);
    }

    public function testAdminCanSeeOrdersAndSendReminderMail()
    {
        $admin = Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($admin, 'admin');

        $customer = Customer::factory()->create();
        $order1 = Order::factory()->create(['customer_id' => $customer->id, 'status' => 'pending']);
        $order2 = Order::factory()->create(['customer_id' => $customer->id, 'status' => 'pending']);

        $response = $this->get(route('order.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.orders');
        $response->assertViewHas('orders');
        $response->assertSee($order1->id);
        $response->assertSee($order2->id);
        $response->assertSee($customer->name);

        Mail::fake();

        $this->patch(route('order.updateStatus', ['uuid' => $order1->uuid]));

        $order1->refresh();
        $this->assertEquals('completed', $order1->status);

       Mail::assertSent(OrderReminderMail::class);
    }
}
