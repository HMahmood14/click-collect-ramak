<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderManager
{
    public function create(array $data): Order
    {
        $order = Order::create([
            'customer_id' => $data['customer_id'],
            'total_price' => 0,
            'pickup_time' => $data['pickup_time'],
        ]);

        $total = 0;

        foreach ($data['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);

            $quantity = $item['quantity'];
            $pricePerKg = $product->price;
            $lineTotal = $pricePerKg * $quantity;

            $stock = $product->curgrentStock;

            if (!$stock || $stock->quantity < $quantity) {
                throw new \Exception("Onvoldoende voorraad voor product: {$product->name}");
            }

            $stock->update([
                'quantity' => $stock->quantity - $quantity
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $lineTotal,
            ]);

            $total += $lineTotal;
        }

        $order->update(['total_price' => $total]);

        return $order;
    }
}
