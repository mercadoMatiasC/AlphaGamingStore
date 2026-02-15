<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    public static function run(Order $order, $verified_input):bool {
        return DB::transaction(function () use ($order, $verified_input) {
            $order_lock = Order::lockForUpdate()->findOrFail($order->id);

            if ($order_lock->canBePaid() || !Payment::where('external_id', $verified_input['external_id'])->exists()){

                $order_lock->payments()->create([
                    'status' => Payment::COMPLETED,
                    'amount' => $verified_input['issued_amount'],
                    'method' => $verified_input['payment_method'],
                    'external_id' => $verified_input['external_id'],
                ]);

                $total = $order_lock->getTotalAndShipping();
                $paidAlready = $order_lock->paidAlready();

                if ($total > $paidAlready)
                    $order_lock->setPartial();
                else
                    if ($total == $paidAlready)
                        $order_lock->setPaid();
                    else
                        $order_lock->setOverpaid();

                return true;
            }else
                return false;
        });
    }
}