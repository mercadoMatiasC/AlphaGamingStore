<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Services\CancelOrderService;
use App\Services\PlaceOrderService;
use DomainException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $user = Auth::user();
        $orders = Auth::user()->orders()->latest()->paginate(4);

        return view('order.index', ['orders' => $orders, 'statuses' => config('order_statuses'), 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        if (!session()->has('cart')) 
            return redirect()->route('cart.index');

        try {
            PlaceOrderService::run(
                user: Auth::user(),
                cart: session('cart'),
                shippingAddressId: session('preferred_address_id')
            );

            return redirect()->route('order.index')->with('message', '¡Compra realizada con éxito!');
        } catch (DomainException $e) {
            $error = $e->getMessage();
            //dd($error);
            return redirect()->route('cart.index')->with('error', (String) $error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order){
        Gate::authorize('view', $order);

        $tracking_statuses = $order->orderTrackingStatuses;
        $items = $order->orderItems()->with('product')->paginate(3);

        return view('order.show', ['order' => $order,'items' => $items, 'statuses' => config('order_statuses'), 'tracking_statuses' => $tracking_statuses,]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order){
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order){
        //
    }

    // -- NON CRUD METHODS --
    public function cancel(Order $order){
        Gate::authorize('cancel', $order);
        CancelOrderService::run(Auth::user(), $order);

        $order->addTrackingStatus('La orden ha sido cancelada por el cliente.');

        return redirect()->route('order.show', $order)->with('success', 'Orden cancelada correctamente!');
    }

    public function clientIndex(User $user){
        $orders = $user->orders()->latest()->paginate(4);

        return view('order.index', ['orders' => $orders, 'statuses' => config('order_statuses'), 'user' => $user,]);
    }

    public function setTrackingURL(Order $order){
        $request = request();

        //VALIDATE
        $validatedInput = $request->validate([
            'shipping_tracking_url' => 'max:128',
        ]);

        $order->update($validatedInput);
        
        //REDIRECT
        return back();
    }
}
