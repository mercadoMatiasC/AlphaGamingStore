<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CancelOrderService;
use App\Services\PlaceOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $orders = Auth::user()->orders()->latest()->paginate(4);

        return view('order.index', ['orders' => $orders, 'statuses' => config('order_statuses'),]);
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

            return redirect()->route('order.index')->with('message', '¡Compra realizada con éxito!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order){
        Gate::authorize('view', $order);

        $tracking_PLACEHOLDER = [
            'DD/MM/AAAA | DETALLE',
            '05/01/2029 | Pedido despachado - https://oca.com.ar/Seguimiento/Paquetes/0000000000',
            '03/01/2029 | Armado del pedido',
            '03/01/2029 | Comprobante aprobado',
            '02/01/2029 | Confirmación de reserva',
            '02/01/2029 | Ingreso del pedido',
        ];

        $items = $order->orderItems()->with('product')->paginate(3);

        return view('order.show', ['order' => $order,'items' => $items, 'statuses' => config('order_statuses'), 'tracking_status' => $tracking_PLACEHOLDER, ]);
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

    // -- NON CRUD METHODS --
    public function cancel(Order $order){
        Gate::authorize('cancel', $order);
        CancelOrderService::run(Auth::user(), $order);

        return redirect()->route('order.show', $order)->with('success', 'Orden cancelada correctamente!');
    }
}
