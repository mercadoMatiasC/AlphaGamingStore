<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $attributes = [
        'shipping_cost' => 0,
        'status' => 'Pendiente',
        'receiptRoute' => null,
    ];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function getTotal(){
        $total = 0;
        $items = $this->orderItems;

        foreach($items as $item)
            $total += $item->snapshot_price*$item->quantity;
        
        return $total;
    }

    public function getTotalAndShipping(){
        return $this->getTotal()+$this->shipping_cost;
    }
}
