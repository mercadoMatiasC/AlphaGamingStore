<?php

namespace App\Http\Controllers;

use App\Domain\Cart;
use App\Models\Product;
use App\Services\ShippingCostService;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    public function initCart(){
        if (!session()->has('cart'))
            session()->put('cart', new Cart());

        if (auth()->check() && auth()->user()->activeAddresses->isNotEmpty() && !session()->has('preferred_address_id'))
            session()->put('preferred_address_id', auth()->user()->activeAddresses->first()->id);
    }

    public function index(){
        $this->initCart();
        $user_addresses = auth()->user()->activeAddresses;

        if (!$user_addresses->isEmpty()){
            $preferred_address = $user_addresses->firstWhere('id', session('preferred_address_id'));

            if (!$preferred_address) {
                $preferred_address = $user_addresses->first();
                session()->put('preferred_address_id', $preferred_address->id);
            }

            $cart = session('cart');
            $sessionProducts = $cart->products;

            $product_ids = collect($sessionProducts)->pluck('product_id')->all();
            $products = Product::whereIn('id', $product_ids)->get()->keyBy('id');

            $itemsView = [];
            $itemsCart = [];
            $load = [];       //FOR SHIPPING COSTS

            foreach ($sessionProducts as $eachItem) {
                $product = $products[$eachItem->product_id] ?? null;

                if ($product) {
                    $quantity = $eachItem->quantity;
                    $finalPrice = $product->finalPrice();

                    $itemsView[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                        'finalPrice' => $finalPrice,
                    ];

                    $itemsCart[] = [
                        'quantity' => $quantity,
                        'finalPrice' => $finalPrice,
                        'before_discount' => $product->priceBeforeDiscount(),
                    ];

                    $load[] = [
                        'category_id' => $product->product_category_id,
                        'quantity' => $quantity,
                    ];
                }
            }

            $prices = $cart->getPrices($itemsCart, ShippingCostService::getShippingCost($preferred_address->province_id, $load));

            return view('cart.index', ['items' => $itemsView, 'prices' => $prices, 'addresses' => $user_addresses, 'activeAddress' => $preferred_address->id]);
        }else{
            return redirect()->route('address.create');
        }
    }

    public function updatePreferredAddress(Request $request){
        $validatedFields = $request->validate(['shipping_address_id' => 'required|exists:shipping_addresses,id']);
        Session::put('preferred_address_id', $validatedFields['shipping_address_id']);

        return back();
    }

    //CART
    public function addCartItem(Request $request){ //$request->product_id AND $request->quantity
        $this->initCart();

        $validatedFields = $request->validate([
                        'product_id' => 'required|exists:products,id',
                        'quantity' => 'required|integer|min:1',
                    ]);

        $product = Product::find($validatedFields['product_id']);

        if ($product && $product->stock>=$request->quantity && $product->active){
            $cart = session('cart');
            $cart->addItem($product->id, $validatedFields['quantity']);
            Session::put('cart', $cart);
        }

        return back();
    }

    public function removeCartItem(Request $request){
        $validatedFields = $request->validate([
                        'product_id' => 'required|exists:products,id',
                    ]);

        $product = Product::find($validatedFields['product_id']);

        if ($product){
            $cart = session('cart');
            $cart->removeItem($product->id);
            Session::put('cart', $cart);
        }

        return back();
    }

    public function updateItemQuantity(Request $request){
        $validatedFields = $request->validate([
                        'product_id' => 'required|exists:products,id',
                        'quantity' => 'required|integer|min:0',
                    ]);

        $product = Product::find($validatedFields['product_id']);

        if ($product && $product->stock>=$request->quantity && $product->active){
            $cart = session('cart');
            $cart->updateQuantity($product->id, $validatedFields['quantity']);
            Session::put('cart', $cart);
        }

        return back();
    }
}
