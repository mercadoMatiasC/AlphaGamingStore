<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $attributes = [
        'shipping_cost' => 0,
        'status' => 0,
        'receiptRoute' => null,
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

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

    public function canBeCancelled(): bool{
        return $this->status == 0;
    }

    public function cancel(){
        $this->status = 2;
        $this->save();
    }

    public function setPending(){
        $this->status = 0;
        $this->save();
    }

    public function setPaid(){
        $this->status = 1;
        $this->save();
    }
}
