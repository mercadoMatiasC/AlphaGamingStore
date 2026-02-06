<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTrackingStatus extends Model
{
    public function order(){
        $this->belongsTo(Order::class);
    }
}
