<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryServices;
use App\Services\ProductServices;
use Illuminate\View\View;

class VisitorController extends Controller
{
    protected CategoryServices $categoryServices;
    protected ProductServices $productServices;

    public function __construct(CategoryServices $categoryServices, ProductServices $productServices)
    {
        $this->categoryServices = $categoryServices;
        $this->productServices = $productServices;
    }

    public function showCategories(): View
    {
        $categories = $this->categoryServices->getAll();

        return view('welcome', compact('categories'));
    }

    public function showProductsByCategory($categoryUuid): View
    {
        $category = Category::where('uuid', $categoryUuid)->firstOrFail();

        $products = $category->products;

        return view('visitor.products', compact('products', 'category'));
    }

}
