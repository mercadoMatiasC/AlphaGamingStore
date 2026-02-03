<?php

namespace App\Services;

use App\Domain\Cart;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PlaceOrderService
{
    public static function run(User $user, Cart $cart, int $shippingAddressId){
        DB::transaction(function () use ($user, $cart, $shippingAddressId) {

            $address = ShippingAddress::findOrFail($shippingAddressId);

            $products = Product::whereIn('id', collect($cart->products)->pluck('product_id'))->get()->keyBy('id');

            $order = $user->orders()->create([
                'status' => 'Pending',
                'address_city' => $address->city,
                'address' => $address->address_street.' '.$address->address_number,
                'receiptRoute' => null,
            ]);

            foreach ($cart->products as $item) {
                $product = $products[$item->product_id];

                $order->orderItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'snapshot_price' => $product->price,
                ]);

                $product->decrement('stock', $item->quantity);
            }

            session()->forget('cart');
        });
    }
}