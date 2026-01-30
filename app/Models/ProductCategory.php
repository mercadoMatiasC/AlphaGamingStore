<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ProductCategoryFactory> */
    use HasFactory;

    public const GPU = 1;
    public const CPU = 2;
    public const RAM = 3;
    public const CASES = 4;
    public const PSU = 5;
    public const PERIPHERALS = 6;
    public const NOTEBOOKS = 7;
    public const BUILT_PC = 8;

    public function products(){
        return $this->hasMany(Product::class);
    }
}
