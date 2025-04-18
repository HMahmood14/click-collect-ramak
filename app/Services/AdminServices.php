<?php

namespace App\Services;

use App\Managers\AdminManager;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminServices
{
    protected AdminManager $adminManager;

    public function __construct(AdminManager $adminManager)
    {
        $this->adminManager = $adminManager;
    }

    public function attemptLogin(string $email, string $password): ?Admin
    {
        $admin = $this->adminManager->getByEmail($email);

        if ($admin && Hash::check($password, $admin->password)) {
            return $admin;
        }

        return null;
    }
}
