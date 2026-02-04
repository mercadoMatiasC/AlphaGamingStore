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

            $address = $user->activeAddresses()->where('id', $shippingAddressId)->firstOrFail();
            $products = Product::whereIn('id', collect($cart->products)->pluck('product_id'))->get()->keyBy('id');

            $order = $user->orders()->create([
                'address_city' => $address->city,
                'address' => $address->address_street.' '.$address->address_number,
            ]);

            $load = [];

            foreach ($cart->products as $item) {
                $product = $products[$item->product_id];
                $quantity = $item->quantity;

                $order->orderItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'snapshot_price' => $product->finalPrice(),
                ]);

                $load[] = [
                    'category_id' => $product->product_category_id,
                    'quantity' => $quantity,
                ];

                $product->decreaseStock($item->quantity);
            }

            $order->shipping_cost = ShippingCostService::getShippingCost($address->province_id, $load);
            $order->save();

            session()->forget('cart');

            return $order;
        });
    }
}