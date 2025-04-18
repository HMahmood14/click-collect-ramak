<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Admin;

class AdminManager
{
    public function getByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }
}
