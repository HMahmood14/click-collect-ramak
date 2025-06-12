<?php

declare(strict_types=1);

namespace App\Services;

use App\Managers\CartManager;

class CartServices
{
    protected CartManager $cartManager;

    public function __construct(CartManager $cartManager)
    {
        $this->cartManager = $cartManager;
    }

    public function getCart(): array
    {
        return $this->cartManager->getCart();
    }

    public function getCartWithProducts(): array
    {
        return $this->cartManager->getCartWithProducts();
    }

    public function addToCart(int $productId, float $quantity, string $type): void
    {
        $this->cartManager->addToCart($productId, $quantity, $type);
    }

    public function updateQuantity(string $uuid, float $quantity): void
    {
        $this->cartManager->updateQuantity($uuid, $quantity);
    }
    public function removeFromCart(string $uuid): void
    {
        $this->cartManager->removeFromCart($uuid);
    }

    public function clearCart(): void
    {
        $this->cartManager->clearCart();
    }

    public function getTotalPrice(): float
    {
        return $this->cartManager->getTotalPrice();
    }
}
