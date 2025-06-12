<?php

declare(strict_types=1);

namespace App\ProductTypes;

use App\Models\Product;

abstract class ProductBase
{

    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    abstract public function calculatePrice(float|int $quantity): float;

    public function getProduct(): Product
    {
        return $this->product;
    }
}
