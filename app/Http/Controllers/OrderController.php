<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\PlaceOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

            return redirect()->route('Home');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
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
