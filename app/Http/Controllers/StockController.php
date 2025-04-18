<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ProductServices;
use App\Services\StockServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StockController extends Controller
{
    protected StockServices $stockServices;
    protected ProductServices $productServices;

    public function __construct(StockServices $stockServices, ProductServices $productServices)
    {
        $this->stockServices = $stockServices;
        $this->productServices = $productServices;
    }

    public function index(): View
    {
        $stocks = $this->stockServices->getAll();
        return view('stock.index', compact('stocks'));
    }

    public function create(): View
    {
        $products = $this->productServices->getAll();
        return view('stock.create', compact('products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'date' => 'nullable|date',
        ]);

        $this->stockServices->create($validated);

        return redirect()->route('stock.index')->with('success', 'Voorraad succesvol toegevoegd.');
    }

    public function edit(int $stockId): View
    {
        $stock = $this->stockServices->getById($stockId);
        $products = $this->productServices->getAll();

        return view('stock.edit', compact('stock', 'products'));
    }

    public function update(Request $request, int $stockId): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'date' => 'nullable|date',
        ]);

        $this->stockServices->update($stockId, $validated);

        return redirect()->route('stock.index')->with('success', 'Voorraad succesvol bijgewerkt.');
    }

    public function destroy(int $stockId): RedirectResponse
    {
        $this->stockServices->delete($stockId);

        return redirect()->route('stock.index')->with('success', 'Voorraad succesvol verwijderd.');
    }
}
