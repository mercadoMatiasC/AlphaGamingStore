<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Services\CheckoutService;
use App\Services\RefundPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Order $order){
        Gate::authorize('view', $order);
        $user = Auth::user();
        return view('payment.create', ['order' => $order, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Order $order){
        $validated_data = $request->validate([
            'payment_method' => 'required',
            'issued_amount' => 'required|numeric|min:0.01',
        ]);

        $validated_data['external_id'] = (string) Str::uuid();
        $response = CheckoutService::run($order, $validated_data);

        return redirect()->route('order.show', $order)->with('response', $response);
    }

    // -- NON CRUD METHODS --
    public function changeStatus(Request $request, Payment $payment){
        if ($payment->canChangeStatus()){
            $response = true;

            $validated_data = $request->validate([
                'status_id' => 'required',
            ]);

            if ($validated_data['status_id'] == Payment::REFUNDED){
                $external_id = (string) Str::uuid();
                $response = RefundPaymentService::run($payment, $external_id);
            }else
                match ((int) $request->status_id) {
                    Payment::PENDING => $payment->setPending(),
                    Payment::COMPLETED => $payment->setCompleted(),
                    Payment::CANCELLED => $payment->setCancelled(),
                    Payment::REJECTED => $payment->setRejected(),
                    default => null,
                };
        }
        return redirect()->route('order.show', $payment->order)->with('response', $response);
    }
}
