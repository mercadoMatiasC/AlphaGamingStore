<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Producto',
            'Envío',
            'Servicio',
            'Tarifa',
        ];

        $slugs = [
            'product',
            'shipping',
            'service',
            'free',
        ];

        for($i=0; $i<count($types); $i++)
            ProductType::create([
                'name' => $types[$i],
                'slug' => $slugs[$i],
            ]);
    }
}
