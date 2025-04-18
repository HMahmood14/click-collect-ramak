<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartManager
{
    public function getCart(): array
    {
        return session('cart', []);
    }

    public function getCartWithProducts(): array
    {
        $cart = $this->getCart();
        $cartWithProducts = [];

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            if ($product) {
                $cartWithProducts[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity'],
                ];
            }
        }

        return $cartWithProducts;
    }

    public function addToCart(int $productId, float $quantity): void
    {
        $cart = $this->getCart();

        $product = Product::findOrFail($productId);
        $uuid = $product->uuid;

        if (isset($cart[$uuid])) {
            $cart[$uuid]['quantity'] += $quantity;
        } else {
            $cart[$uuid] = [
                'product_id' => $productId,
                'uuid' => $uuid,
                'quantity' => $quantity,
                'name' => $product->name,
                'price' => $product->price
            ];
        }

        Session::put('cart', $cart);
    }

    public function updateQuantity(string $uuid, float $quantity): void
    {
        $cart = $this->getCart();

        if (isset($cart[$uuid])) {
            if ($quantity <= 0.0) {
                unset($cart[$uuid]);
            } else {
                $cart[$uuid]['quantity'] = $quantity;
            }
        }

        Session::put('cart', $cart);
    }

    public function removeFromCart(string $uuid): void
    {
        $cart = $this->getCart();

        foreach ($cart as $key => $item) {
            if ($item['uuid'] === $uuid) {
                unset($cart[$key]);
                break;
            }
        }

        Session::put('cart', $cart);
    }

    public function clearCart(): void
    {
        Session::forget('cart');
    }

    public function getTotalPrice(): float
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item)
        {
            $product = Product::find($item['product_id']);
            $total += $item['quantity'] * $product['price'];
        }
        return $total;
    }
}
