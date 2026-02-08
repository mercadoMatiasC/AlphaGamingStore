<?php

namespace App\Services;

use App\Domain\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use DomainException;

class PlaceOrderService
{
    public static function run(User $user, Cart $cart, int $shippingAddressId)
    {
        try {
            return DB::transaction(function () use ($user, $cart, $shippingAddressId) {
                $address = $user->activeAddresses()->where('id', $shippingAddressId)->firstOrFail();
                $products = Product::whereIn('id', collect($cart->products)->pluck('product_id'))->get()->keyBy('id');

                $order = $user->orders()->create([
                    'address_city' => $address->city,
                    'address' => $address->address_street . ' ' . $address->address_number,
                ]);

                foreach ($cart->products as $item) {
                    $product = $products[$item->product_id];

                    $order->orderItems()->create([
                        'product_id' => $product->id,
                        'quantity' => $item->quantity,
                        'snapshot_price' => $product->finalPrice(),
                    ]);

                    $product->decreaseStock($item->quantity);
                }

                $order->shipping_cost = ShippingCostService::getShippingCost($address->province_id, []);

                $order->save();
                $order->addTrackingStatus('Ingreso del pedido.');

                session()->forget('cart');

                return $order;
            });
        } catch (DomainException $e) {
            throw $e;
        }
    }
}