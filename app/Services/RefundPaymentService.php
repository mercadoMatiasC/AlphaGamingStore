<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Refund;
use Illuminate\Support\Facades\DB;

class RefundPaymentService
{
    public static function run(Payment $payment, $external_id):bool {
        return DB::transaction(function () use ($payment, $external_id) {
            $payment_lock = Payment::lockForUpdate()->findOrFail($payment->id);

            if ($payment_lock->canBeRefunded() || !Refund::where('external_id', $external_id)->exists()){
                $amount = $payment_lock->amount;

                $payment_lock->refunds()->create([
                    'amount' => $amount,
                    'external_id' => $external_id,
                ]);

                $payment_lock->setRefunded();
                return true;
            }else
                return false;
        });
    }
}