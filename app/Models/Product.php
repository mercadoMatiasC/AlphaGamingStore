<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function type(){
        return $this->belongsTo(ProductType::class);
    }

    public function category(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function finalPrice(){
        return $this->price*(1-$this->discount);
    }

    public function priceBeforeDiscount(){
        return $this->price;
    }

    public function normalizedDescription(){
        $normalized = str_replace(["\r\n", "\r"], "\n", $this->description);
        return array_filter(array_map('trim', explode(',', $normalized)));
    }

    public function questions(){
        return $this->hasMany(ProductQuestion::class);
    }

    public function getFPriceAttribute(){
        return number_format($this->price, 0, '.', ',');
    }

    public function getFFinalAttribute(){
        return number_format($this->finalPrice(), 0, '.', ',');
    }

    public function getFDiscountedAttribute(){
        return number_format($this->price - $this->finalPrice(), 0, '.', ',');
    }

    public function decreaseStock($quantity){
        if ($quantity <= 0) 
            throw new \InvalidArgumentException('Must be a positive amount.');

        if ($this->stock < $quantity) 
            throw new \DomainException("No hay stock suficiente para {$this->name}. Hay {$this->stock} unidad/es disponibles.");
        else
            $this->decrement('stock', $quantity);
    }

    public function increaseStock($quantity){
        if ($quantity <= 0) 
            throw new \InvalidArgumentException('Must be a positive amount.');
        else
            $this->increment('stock', $quantity);
    }
}
