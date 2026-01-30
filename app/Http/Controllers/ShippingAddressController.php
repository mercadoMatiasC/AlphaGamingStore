<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShippingAddressController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $provinces = config('provinces');

        return view('shipping_address.create', ['provinces' => $provinces]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        //VALIDATE
        $validatedAddress = $request->validate([
            'province_id' => ['required', Rule::in(collect(config('provinces'))->pluck('id')->all())],
            'city' => 'required',
            'postal_code' => 'required',
            'address_street' => 'required',
            'address_number' => 'required',
            'information' => 'nullable|string|max:128',
        ]);

        $request->user()->shipping_addresses()->create([
            ...$validatedAddress,
            'active' => true,
        ]);
        
        //REDIRECT
        return redirect('/Perfil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(ShippingAddress $address){
        $request = request();

        //VALIDATE
        $validatedAddressInfo = $request->validate([
            'new_information' => 'required|string|max:128',
        ]);

        $address->update([
                'information' => $validatedAddressInfo['new_information'],
            ]);
        
        //REDIRECT
        return back();
    }

     //-- NON CRUD METHODS --
    public function toggleEnable(ShippingAddress $address){  
        $address->update(['active' => !$address->active]);
        return back();
    }
}
    