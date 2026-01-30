<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Tarjetas de video',
            'Procesadores',
            'RAMs',
            'Gabinetes',
            'Fuentes',
            'Periféricos',
            'Notebooks',
            'PCs armadas',
        ];

        $slugs = [
            'gpu',
            'cpu',
            'ram',
            'cases',
            'psu',
            'peripherals',
            'notebooks',
            'built_pc'
        ];

        for ($i=0; $i<count($categories); $i++)
            ProductCategory::create([
                'name' => $categories[$i], 
                'slug' => $slugs[$i], 
            ]);
    }
}
