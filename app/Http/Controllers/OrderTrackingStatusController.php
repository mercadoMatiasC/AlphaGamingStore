<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderTrackingStatus;
use Illuminate\Http\Request;

class OrderTrackingStatusController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Order $order){
        $request = request();

        //VALIDATE
        $validatedInput = $request->validate([
            'details' => 'required',
        ]);

        //CREATE TRACKING STATUS
        $order->orderTrackingStatuses()->create([
            'details' => $validatedInput['details'],
        ]);

        //REDIRECT
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderTrackingStatus $status){
        $request = request();

        //VALIDATE
        $validatedInput = $request->validate([
            'details' => 'required',
        ]);

        $status->update($validatedInput);
        
        //REDIRECT
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderTrackingStatus $status){
        $status->delete();
        return back();
    }
}
