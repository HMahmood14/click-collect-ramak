<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\CartServices;
use App\Services\OrderServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class OrderController extends Controller
{

    protected OrderServices $orderServices;
    protected CartServices $cartServices;

    public function __construct(OrderServices $orderServices, CartServices $cartServices)
    {
        $this->orderServices = $orderServices;
        $this->cartServices = $cartServices;
    }

    public function showCheckoutForm(): View
    {
        $cartItems = Session::get('cart', []);
        $total = $this->cartServices->getTotalPrice();

        return view('visitor.checkout', compact('cartItems', 'total'));
    }

    public function placeOrder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'pickup_time' => 'required|date',
        ]);

        $orderData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'pickup_time' => $validated['pickup_time'],
            'items' => Session::get('cart', []),
        ];

        try {
            $this->orderServices->createOrder($orderData);
            Session::forget('cart');
            return redirect()->route('checkout.form')->with('success', 'Bestelling succesvol geplaatst. Er is een e-mail naar u verstuurd met de details van de bestelling.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
