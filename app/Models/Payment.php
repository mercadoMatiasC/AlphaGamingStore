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

    public function refunds(){
        return $this->hasMany(Refund::class);
    }

    //OTHER METHODS
    public function canBeRefunded(){
        return $this->status == self::COMPLETED;
    }

    public function canChangeStatus(){
        return ($this->status != self::CANCELLED) && ($this->status != self::REFUNDED);
    }

     //SETTINGS
    public function setPending(){
        $this->status = self::PENDING;
        $this->save();
    }

    public function setCompleted(){
        $this->status = self::COMPLETED;
        $this->save();
    }

    public function setCancelled(){
        $this->status = self::CANCELLED;
        $this->save();
    }

    public function setRefunded(){
        $this->status = self::REFUNDED;
        $this->save();
    }

    public function setRejected(){
        $this->status = self::REJECTED;
        $this->save();
    }
}
