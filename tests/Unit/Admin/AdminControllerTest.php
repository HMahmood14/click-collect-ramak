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
}
