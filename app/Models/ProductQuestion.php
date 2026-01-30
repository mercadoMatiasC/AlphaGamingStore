<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductQuestion extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answers(){
        return $this->hasMany(ProductAnswers::class);
    }
}
