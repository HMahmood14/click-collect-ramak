<?php

namespace App\ProductTypes;



class KiloProduct extends ProductBase
{
    public function calculatePrice(float|int $quantity): float
    {
        return $this->product->price * $quantity;
    }
}
