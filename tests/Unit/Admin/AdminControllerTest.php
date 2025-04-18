<?php

declare(strict_types=1);

namespace Tests\Unit\Admin;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanLoginWithValidCredentials()
    {
        $admin = Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function testAdminCannotLoginWithInvalidCredentials()
    {
        Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function testAdminCanLogout()
    {
        $admin = Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($admin, 'admin');

        $response = $this->post('/admin/logout');

        $response->assertRedirect('/');
        $this->assertGuest('admin');
    }

    public function testAdminCanSeeOrders()
    {
        $this->actingAs(Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]), 'admin');

        $customer = Customer::factory()->create();
        $order1 = Order::factory()->create(['customer_id' => $customer->id]);
        $order2 = Order::factory()->create(['customer_id' => $customer->id]);

        $response = $this->get(route('admin.orders'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.orders');
        $response->assertViewHas('orders');
        $response->assertSee($order1->id);
        $response->assertSee($order2->id);
        $response->assertSee($customer->name);
    }
}
