<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Refund;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Order $order){
        $payment_base_statuses = array_map(function ($item) {
            return [
                    'id' => $item['id'], 
                    'status' => $item['status'],
                    'colour' => $item['colour']
                   ];
        }, config('payment_statuses'));

        $refunds = $order->refunds()->with('payment')->latest()->paginate(5);

        return view('refund.index', compact('refunds', 'order', 'payment_base_statuses'));
    }
}
