<?php

namespace App\Domain;

class CartProduct {

    //ATT
    public int $product_id;
    public int $quantity;

    //MET
    public function __construct($product_id, $quantity) {
        $this->product_id = $product_id; //NEED TO VALIDATE IF IT EXISTS FROM DB
        $this->quantity = $quantity; //NEED TO VALIDATE IT FROM DB
    }

    public function setQuantity($new_quantity){
        if ($new_quantity >= 0)
            $this->quantity = $new_quantity;
    }

    public function getQuantity(){
        return $this->quantity;
    }
}
?>