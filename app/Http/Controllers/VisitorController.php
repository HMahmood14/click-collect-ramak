<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CartServices;
use App\Services\CategoryServices;
use App\Services\ProductServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorController extends Controller
{
    protected CategoryServices $categoryServices;
    protected ProductServices $productServices;
    protected CartServices $cartService;

    public function __construct(CategoryServices $categoryServices, ProductServices $productServices, CartServices $cartServices)
    {
        $this->categoryServices = $categoryServices;
        $this->productServices = $productServices;
        $this->cartService = $cartServices;
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

    public function showProduct(string $uuid): View
    {
        $product = $this->productServices->getProductByUuid($uuid);

        if (!$product) {
            return redirect()->route('home')->with('error', 'Product niet gevonden');
        }

        return view('visitor.product', compact('product'));
    }

    public function addToCart(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|numeric|min:0.1',
        ]);



        $productId = (int) $validated['product_id'];
        $quantity = (float) $validated['quantity'];

        $this->cartService->addToCart($productId, $quantity);

        return back()->with('success', 'Product toegevoegd aan winkelmandje.');
    }

    public function updateCartQuantity(Request $request, string $uuid): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|numeric|min:0.1',
        ]);

        $this->cartService->updateQuantity($uuid, $validated['quantity']);

        return back()->with('success', 'Hoeveelheid aangepast.');
    }

    public function showCart(): View
    {
        $cartItems = $this->cartService->getCartWithProducts();
        $total = $this->cartService->getTotalPrice();

        return view('visitor.cart', compact('cartItems', 'total'));
    }

    public function removeFromCart(string $uuid): RedirectResponse
    {
        $this->cartService->removeFromCart($uuid);
        return back()->with('success', 'Product verwijderd uit winkelmandje.');
    }

    public function clearCart(): RedirectResponse
    {
        $this->cartService->clearCart();
        return back()->with('success', 'Winkelmandje geleegd.');
    }
}
