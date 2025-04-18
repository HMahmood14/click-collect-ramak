<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AdminServices;
use App\Services\CategoryServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VisitorController extends Controller
{
    protected CategoryServices $categoryServices;

    public function __construct(CategoryServices $categoryServices)
    {
        $this->categoryServices = $categoryServices;
    }

    public function show(): View
    {
        $categories = $this->categoryServices->getAll();

        return view('welcome', compact('categories'));
    }

}
