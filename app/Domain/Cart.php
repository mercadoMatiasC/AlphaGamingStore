<?php

namespace App\Domain;

use App\Domain\CartProduct;
use App\Models\Product;

class Cart {
    //ATT
    public $products; //CartProduct Array

    //MET
    public function __construct() {
        $this->products = [];
    }

    public function inCart($product_id){
        $search = array_filter($this->products, function ($eachProduct) use ($product_id) {
            return $eachProduct->product_id == $product_id;
        });

        return reset($search);
    }

    public function addItem($product_id, $quantity){
        if (!$this->inCart($product_id)){
            $product = new CartProduct($product_id, $quantity);
            array_push($this->products, $product);
        }
    }

    public function removeItem($product_id){
        $this->products = array_filter($this->products, function ($eachProduct) use ($product_id) {
            return $eachProduct->product_id !== $product_id;
        });

        // Re-index the array
        $this->products = array_values($this->products);
    }

    public function updateQuantity($product_id, $new_quantity){
        $found = $this->inCart($product_id);

        if ($found){
            if ($new_quantity > 0)
                $found->setQuantity($new_quantity);
            else
                $this->removeItem($found->product_id);
        }
    }

    public function getPrices($itemsCart, $shipment_cost){
        $prices = [
            'final' => 0,
            'before_discount' => 0,
            'discounted' => 0,
            'shipment_cost' => $shipment_cost,
        ];

        foreach ($itemsCart as $item){
            $prices['final'] += $item['finalPrice']*$item['quantity'];
            $prices['before_discount'] += $item['before_discount']*$item['quantity'];
        }

        $prices['discounted'] = $prices['before_discount'] - $prices['final'];
        $prices['final'] += $prices['shipment_cost'];

        return $prices;
    }
}
?>