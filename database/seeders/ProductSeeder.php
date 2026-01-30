<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
                        [
                            'product_type_id' => 1,
                            'product_category_id' => 2,
                            'sku' => 'CPU-INT-I59500#-###-####',
                            'name' => 'Procesador i5 9500 4.4Ghz Socket LGA1151 Coffee Lake',
                            'brand' => 'Intel',
                            'price' => '165900.00',
                            'discount' => '0.25',
                            'description' =>    'Arquitectura=Coffee Lake,Socket=LGA1151,Tipo de memoria=DDR4,Número de núcleos=6,Número de hilos=6,TDP=65W,Frecuencia base=3.00GHz,Frecuencia turbo=4.40GHz',
                            'stock' => 1,
                            'imagesRoute' => 'products/1/1.png',
                            'active' => 1,
                        ],
                        [
                            'product_type_id' => 1,
                            'product_category_id' => 1, // Tarjetas de video
                            'sku' => 'GPU-NVD-RTX3060-12G-###',
                            'name' => 'Placa de Video NVIDIA RTX 3060 12GB',
                            'brand' => 'NVIDIA',
                            'price' => '489900.00',
                            'discount' => '0.10',
                            'description' => 'Modelo=RTX 3060,Memoria=12GB GDDR6,Interfaz=PCIe 4.0,Resolución máxima=8K,Consumo=170W',
                            'stock' => 5,
                            'imagesRoute' => 'products/2/1.png',
                            'active' => 1,
                        ],
                        [
                            'product_type_id' => 1,
                            'product_category_id' => 3, // RAMs
                            'sku' => 'RAM-COR-DDR4-16GB-3200',
                            'name' => 'Memoria RAM Corsair DDR4 16GB 3200MHz',
                            'brand' => 'Corsair',
                            'price' => '74900.00',
                            'discount' => '0.05',
                            'description' => 'Capacidad=16GB,Tipo=DDR4,Frecuencia=3200MHz,Voltaje=1.35V',
                            'stock' => 10,
                            'imagesRoute' => 'products/3/1.png',
                            'active' => 1,
                        ],
                        [
                            'product_type_id' => 1,
                            'product_category_id' => 4, // Gabinetes
                            'sku' => 'CAB-SEN-ARGB-MIDTOWER',
                            'name' => 'Gabinete Sentey Mid Tower ARGB',
                            'brand' => 'Sentey',
                            'price' => '58900.00',
                            'discount' => '0.00',
                            'description' => 'Formato=Mid Tower,Iluminación=ARGB,Compatibilidad=ATX / Micro ATX / Mini ITX',
                            'stock' => 7,
                            'imagesRoute' => 'products/4/1.png',
                            'active' => 1,
                        ],
                        [
                            'product_type_id' => 1,
                            'product_category_id' => 5, // Fuentes
                            'sku' => 'PSU-SEAS-650W-GOLD',
                            'name' => 'Fuente Seasonic 650W 80 Plus Gold',
                            'brand' => 'Seasonic',
                            'price' => '129900.00',
                            'discount' => '0.08',
                            'description' => 'Potencia=650W,Certificación=80 Plus Gold,Modular=Semi modular',
                            'stock' => 4,
                            'imagesRoute' => 'products/5/1.png',
                            'active' => 1,
                        ],
                        //PCS ARMADAS
                        [
                            'product_type_id' => 1,
                            'product_category_id' => 8,
                            'sku' => 'PCA-HEP-R7X4070-R7X-RTX4',
                            'name' => 'PC Gamer Ryzen 7 5700X 32GB RTX 4070',
                            'brand' => 'Alpha Gaming Warehouse',
                            'price' => '1763900.00',
                            'discount' => '0.15',
                            'description' => 'Procesador=Ryzen 7 5700X,Tarjeta gráfica=MSI GeForce RTX 4070 12GB,Memoria RAM=G.Skill DDR4 32GB (2x16GB) 3200MHz,Motherboard=MSI B550M PRO VDH AM4,Fuente de energía=Seasonic Core V2 GX-650 650W,Almacenamiento principal=SSD Western Digital SN5000S PCIe 4 NVME 512gb,Almacenamiento secundario=HDD Western Digital BLUE WD10EZEX 1TBGabinete=Sentey Walker 360 ARGB,Sistema operativo=Windows 10 Pro x64 activado',
                            'stock' => 1,
                            'imagesRoute' => 'products/6/1.png',
                            'active' => 1,
                        ],
                        [
                            'product_type_id' => 1,
                            'product_category_id' => 8, // PCs armadas
                            'sku' => 'PCA-AMD-R55600X-RTX3060',
                            'name' => 'PC Gamer Ryzen 5 5600X RTX 3060',
                            'brand' => 'Alpha Gaming Warehouse',
                            'price' => '1249900.00',
                            'discount' => '0.12',
                            'description' => 'Procesador=Ryzen 5 5600X,
                                            GPU=RTX 3060 12GB,
                                            RAM=16GB DDR4,
                                            Almacenamiento=SSD NVMe 1TB,
                                            SO=Windows 10 Pro',
                            'stock' => 2,
                            'imagesRoute' => 'products/7/1.png',
                            'active' => 1,
                        ],
                        [
                            'product_type_id' => 1,
                            'product_category_id' => 8,
                            'sku' => 'PCA-INT-I713700-RTX4070',
                            'name' => 'PC Gamer Intel i7 13700 RTX 4070',
                            'brand' => 'Alpha Gaming Warehouse',
                            'price' => '2199900.00',
                            'discount' => '0.10',
                            'description' => 'Procesador=Intel i7 13700,GPU=RTX 4070 12GB,RAM=32GB DDR5,Almacenamiento=SSD NVMe 2TB,SO=Windows 11 Pro',
                            'stock' => 1,
                            'imagesRoute' => 'products/8/1.png',
                            'active' => 1,
                        ],
                        [
                            'product_type_id' => 1,
                            'product_category_id' => 8,
                            'sku' => 'PCA-AMD-R75800X3D-RTX4080',
                            'name' => 'PC Gamer Ryzen 7 5800X3D RTX 4080',
                            'brand' => 'Alpha Gaming Warehouse',
                            'price' => '3299900.00',
                            'discount' => '0.05',
                            'description' => 'Procesador=Ryzen 7 5800X3D,GPU=RTX 4080 16GB,RAM=32GB DDR4,Almacenamiento=SSD NVMe 2TB,Refrigeración=Liquida 360mm',
                            'stock' => 1,
                            'imagesRoute' => 'products/9/1.png',
                            'active' => 1,
                        ],
                        [
                            'product_type_id' => 1,
                            'product_category_id' => 8,
                            'sku' => 'PCA-INT-I512400F-RTX3050',
                            'name' => 'PC Gamer Intel i5 12400F RTX 3050',
                            'brand' => 'Alpha Gaming Warehouse',
                            'price' => '999900.00',
                            'discount' => '0.15',
                            'description' => 'Procesador=Intel i5 12400F,GPU=RTX 3050 8GB,RAM=16GB DDR4,Almacenamiento=SSD NVMe 512GB,SO=Windows 10 Home',
                            'stock' => 3,
                            'imagesRoute' => 'products/10/1.png',
                            'active' => 1,
                        ],
                    ];

         
        foreach($products as $product)
            Product::create($product);
    }
}
