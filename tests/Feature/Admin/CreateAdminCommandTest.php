<?php

declare(strict_types=1);

namespace Feature\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAdminCommandTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminIsCreatedSuccessfully(): void
    {
        $this->artisan('admin:create')
            ->expectsQuestion('Wat is de naam van de admin?', 'John Doe')
            ->expectsQuestion('Wat is het e-mailadres voor de admin?', 'john@example.com')
            ->expectsQuestion('Wat is het wachtwoord voor de admin?', 'secret123')
            ->expectsOutput('Admin account succesvol aangemaakt!')
            ->assertExitCode(0);

        $this->assertDatabaseHas('admins', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    public function testInvalidEmailShowsError(): void
    {
        $this->artisan('admin:create')
            ->expectsQuestion('Wat is de naam van de admin?', 'Invalid Email')
            ->expectsQuestion('Wat is het e-mailadres voor de admin?', 'not-an-email')
            ->expectsOutput('Het ingevoerde e-mailadres is ongeldig.')
            ->assertExitCode(0);

        $this->assertDatabaseMissing('admins', [
            'email' => 'not-an-email',
        ]);
    }

    public function testDuplicateEmailShowsError(): void
    {
        Admin::factory()->create([
            'email' => 'already@taken.com',
        ]);

        $this->artisan('admin:create')
            ->expectsQuestion('Wat is de naam van de admin?', 'Another User')
            ->expectsQuestion('Wat is het e-mailadres voor de admin?', 'already@taken.com')
            ->expectsOutput('Dit e-mailadres is al in gebruik.')
            ->assertExitCode(0);
    }
}
