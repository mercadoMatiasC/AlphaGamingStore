<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAnswers extends Model
{
    public function question(){
        return $this->belongsTo(ProductQuestion::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
