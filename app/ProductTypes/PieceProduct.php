<?php

namespace App\ProductTypes;

class PieceProduct extends ProductBase
{
    public function calculatePrice(float|int $quantity): float
    {
        return ceil($quantity) * $this->product->price;
    }
}
