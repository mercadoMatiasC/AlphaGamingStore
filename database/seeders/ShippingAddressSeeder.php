<?php

namespace Database\Seeders;

use App\Models\ShippingAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        ShippingAddress::create([
            'user_id' => 1,
            'province_id' => 17,
            'city' => 'San Juan',
            'postal_code' => '5400',
            'address_street' => 'San Martin',
            'address_number' => '2900E',
            'information' => 'Tocar timbre azul.',
            'active' => 1,
        ]);

        ShippingAddress::create([
            'user_id' => 1,
            'province_id' => 1,
            'city' => 'La Matanza',
            'postal_code' => '6700',
            'address_street' => 'Lujan',
            'address_number' => '8530',
            'information' => 'Aplaudir o tocar bocina.',
            'active' => 1,
        ]);

        ShippingAddress::create([
            'user_id' => 3,
            'province_id' => 17,
            'city' => 'San Juan',
            'postal_code' => '5400',
            'address_street' => 'La Rioja',
            'address_number' => '1903E',
            'information' => 'Casa con rejas negras.',
            'active' => 1,
        ]);

        ShippingAddress::create([
            'user_id' => 4,
            'province_id' => 1,
            'city' => 'Hurlingham',
            'postal_code' => '1100',
            'address_street' => 'Dorrego',
            'address_number' => '4031',
            'information' => 'Departamento tocar timbre 2B.',
            'active' => 1,
        ]);
    }
}