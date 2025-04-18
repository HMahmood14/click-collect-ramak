<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AdminServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    protected AdminServices $adminServices;

    public function __construct(AdminServices $adminServices)
    {
        $this->adminServices = $adminServices;
    }

    public function showLoginForm(): View
    {
        return view('admin.login');
    }

    public function dashboard():View
    {
        $admin = auth('admin')->user();

        return view('admin.dashboard', ['admin' => $admin]);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = $this->adminServices->attemptLogin($credentials['email'], $credentials['password']);

        if ($admin) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Ongeldige inloggegevens.',
        ]);
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
