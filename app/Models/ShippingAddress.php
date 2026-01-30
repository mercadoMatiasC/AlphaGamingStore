<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model {

     public function getProvinceName(): ?string {
        $province_id = $this->province_id;

        return collect(config('provinces'))->firstWhere('id', $province_id)['name'] ?? NULL;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
