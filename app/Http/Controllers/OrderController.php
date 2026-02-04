<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\PlaceOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $orders = Auth::user()->orders()->latest()->paginate(4);

        return view('order.index', ['orders' => $orders,]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        if (!session()->has('cart')) 
            return redirect()->route('cart.index');
        else{
            PlaceOrderService::run(
                user: Auth::user(),
                cart: session('cart'),
                shippingAddressId: session('preferred_address_id')
            );

            return redirect()->route('order.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order){

        return view('order.show', ['order' => $order, 'items' => $order->orderItems,]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }
}
