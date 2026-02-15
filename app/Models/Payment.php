<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public const PENDING = 0;
    public const COMPLETED = 1;
    public const CANCELLED = 2;
    public const REFUNDED = 3;
    public const REJECTED = 4;

    protected $attributes = [
        'status' => self::PENDING,
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
