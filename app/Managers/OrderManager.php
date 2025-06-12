<?php

declare(strict_types=1);

namespace App\Managers;

use App\Jobs\SendReminderEmail;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

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
            $product = Product::where('uuid', $item['uuid'])->firstOrFail();

            $quantity = $item['quantity'];
            $typedProduct = $product->asType();
            $lineTotal = $typedProduct->calculatePrice($quantity);

            $stock = $product->currentStock;

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
        $order->load('customer', 'items');

        Mail::to($order->customer->email)->send(new OrderConfirmationMail($order));

        return $order;
    }

    public function updateStatusAndSendReminder(string $uuid): bool
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();

        if ($order->status === 'pending') {
            $order->status = 'completed';
            $order->save();

            SendReminderEmail::dispatch($order);

            return true;
        }

        return false;
    }

    public function getAllOrders(): Collection
    {
        return Order::with('customer', 'items.product')->get();
    }

    public function delete(string $uuid): bool
    {
        $order = Order::where('uuid', $uuid)->first();

        if ($order) {
            return $order->delete();
        }
        return false;
    }
}
