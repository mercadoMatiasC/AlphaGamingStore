<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $attributes = [
        'shipping_cost' => 0,
        'status' => 0,
        'receiptRoute' => NULL,
        'shipping_tracking_url' => NULL
    ];

    // -- RELATIONSHIPS --
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function orderTrackingStatuses(){
        return $this->hasMany(OrderTrackingStatus::class)->orderBy('created_at', 'desc');
    }

    // -- OTHER METHODS --
    public function getTotal(){
        $total = 0;
        $items = $this->orderItems;

        foreach($items as $item)
            $total += $item->snapshot_price*$item->quantity;
        
        return $total;
    }

    public function addTrackingStatus($details){
        $this->orderTrackingStatuses()->create(['details' => $details]);
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
