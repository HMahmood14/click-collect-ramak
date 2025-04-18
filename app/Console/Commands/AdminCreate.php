<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AdminCreate extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Maak een admin account aan';

    public function handle()
    {
        $name = $this->ask('Wat is de naam van de admin?');

        $email = $this->ask('Wat is het e-mailadres voor de admin?');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error("Het ingevoerde e-mailadres is ongeldig.");
            return;
        }

        if (Admin::where('email', $email)->exists()) {
            $this->error("Dit e-mailadres is al in gebruik.");
            return;
        }

        $password = $this->secret('Wat is het wachtwoord voor de admin?');

        Admin::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("Admin account succesvol aangemaakt!");
    }
}
