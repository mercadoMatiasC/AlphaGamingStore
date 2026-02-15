<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const PENDING = 0;
    public const PAID = 1;
    public const CANCELLED = 2;
    public const PARTIAL = 3;
    public const OVERPAID = 4;
    public const DELIVERED = 5;

    protected $attributes = [
        'shipping_cost' => 0,
        'status' => self::PENDING,
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

    public function payments(){
        return $this->hasMany(Payment::class);
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

    public function canChangeStatus(): bool{
        return $this->status != self::CANCELLED;
    }

    public function paidAlready(){
        return $this->payments()->sum('amount');
    }

    public function isFullyPaid(): bool{
        return $this->payments()->sum('amount')>= $this->getTotalAndShipping();
    }

    public function canBePaid(): bool{
        return ($this->status == self::PENDING) || ($this->status == self::PARTIAL);
    }

    //SETTINGS
    public function setPending(){
        $this->status = self::PENDING;
        $this->save();
    }

    public function setPartial(){
        $this->status = self::PARTIAL;
        $this->save();
    }

    public function setOverpaid(){
        $this->status = self::OVERPAID;
        $this->save();
    }

    public function setPaid(){
        $this->status = self::PAID;
        $this->addTrackingStatus('El pago ha sido recibido y aprobado.');
        $this->save();
    }

    public function cancel(){
        $this->status = self::CANCELLED;
        $this->save();
    }

    public function setDelivered(){
        $this->status = self::DELIVERED;
        $this->addTrackingStatus('Envío entregado con éxito, ¡Que lo disfrutes!.');
        $this->save();
    }
}
