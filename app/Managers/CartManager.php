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
                $price = $product->asType()->calculatePrice($item['quantity']);

                $cartWithProducts[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'type' => $item['type'],
                    'subtotal' => $price,
                ];
            }
        }

        return $cartWithProducts;
    }

    public function addToCart(int $productId, float $quantity, string $type): void
    {
        $cart = $this->getCart();

        $product = Product::findOrFail($productId);
        $uuid = $product->uuid;

        if (isset($cart[$uuid])) {
            // Als het product al in de cart zit, check of type overeenkomt
            if ($cart[$uuid]['type'] === $type) {
                $cart[$uuid]['quantity'] += $quantity;
            } else {
                // Verschillend type? Je kunt er voor kiezen om een nieuw item te maken met type in key
                $key = $uuid . '_' . $type;
                if (isset($cart[$key])) {
                    $cart[$key]['quantity'] += $quantity;
                } else {
                    $cart[$key] = [
                        'product_id' => $productId,
                        'uuid' => $uuid,
                        'quantity' => $quantity,
                        'name' => $product->name,
                        'price' => $product->price,
                        'type' => $type,
                    ];
                }
            }
        } else {
            // Eerste keer toevoegen
            $cart[$uuid] = [
                'product_id' => $productId,
                'uuid' => $uuid,
                'quantity' => $quantity,
                'name' => $product->name,
                'price' => $product->price,
                'type' => $type,
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
            if ($product) {
                $total += $product->asType()->calculatePrice($item['quantity']);
            }
        }
        return $total;
    }
}
