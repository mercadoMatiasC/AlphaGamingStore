<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'mattTheWolf',
            'email' => 'carlosmercado--@hotmail.com',
            'password' => '123123123',
            'profile_imageRoute' => 'users/1/1.webp',
            'personal_id' => '33333333',
            'account_status' => true,
            'role_id' => '1',
        ]);

        User::factory()->create([
            'name' => 'pepito',
            'email' => 'pepito@gmail.com',
            'password' => '123123123',
            'profile_imageRoute' => 'users/2/1.webp',
            'personal_id' => NULL,
            'account_status' => true,
            'role_id' => '3',
        ]);

        User::factory()->create([
            'name' => 'tobiasnana33',
            'email' => 'tobiasnana33@gmail.com',
            'password' => '333333',
            'profile_imageRoute' => 'users/3/1.webp',
            'personal_id' => NULL,
            'account_status' => true,
            'role_id' => '3',
        ]);

        User::factory()->create([
            'name' => 'killepo',
            'email' => 'thedragofirexx@gmail.com',
            'password' => '333333',
            'profile_imageRoute' => 'users/4/1.webp',
            'personal_id' => NULL,
            'account_status' => true,
            'role_id' => '3',
        ]);
    }
}
