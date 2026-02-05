<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use DomainException;
use Illuminate\Support\Facades\DB;

class CancelOrderService
{
    public static function run(User $user, Order $order): Order
    {
        if (! $order->canBeCancelled()) 
            throw new DomainException('La orden no puede cancelarse');
        else
            return DB::transaction(function () use ($order) {

                $order->load('orderItems.product');

                foreach ($order->orderItems as $item) 
                    $item->product->increaseStock($item->quantity);

                $order->cancel();

                return $order;
            });
    }
}