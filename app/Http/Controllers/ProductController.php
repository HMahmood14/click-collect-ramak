<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryServices;
use App\Services\ProductServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $productServices;
    protected $categoryServices;

    public function __construct(ProductServices $productServices, CategoryServices $categoryServices)
    {
        $this->productServices = $productServices;
        $this->categoryServices = $categoryServices;
    }

    public function index(): View
    {
        $products = $this->productServices->getAll();
        return view('product.index', compact('products'));
    }

    public function create(): View
    {
        $categories = $this->categoryServices->getAll();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:kilo,stuk',
        ]);

        $category = Category::findOrFail($validated['category_id']);

        $this->productServices->createProduct([
            'name' => $request->input('name'),
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $category->id,
            'type' => $validated['type'],
        ]);

        return redirect()->route('product.index')->with('success', 'Product succesvol toegevoegd.');
    }

    public function edit($uuid): View
    {
        $product = $this->productServices->getProductByUuid($uuid);
        $categories = $this->categoryServices->getAll();

        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $uuid): RedirectResponse
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric',
        ]);

        $product = $this->productServices->getProductByUuid($uuid);

        if ($product) {
             $this->productServices->updateProduct($uuid, [
                 'name' => $request->input('name'),
                 'description' => $request->input('description'),
                 'price' => $request->input('price'),
                 'category_id' => $request->input('category_id'),
            ]);

            return redirect()->route('product.index')->with('success', 'Product succesvol aangepast.');
        }

        return redirect()->route('product.index')->with('error', 'Product niet gevonden.');
    }

    public function destroy($uuid): RedirectResponse
    {
        $this->productServices->deleteProduct($uuid);

        return redirect()->route('product.index')->with('success', 'Product succesvol verwijderd.');
    }
}
