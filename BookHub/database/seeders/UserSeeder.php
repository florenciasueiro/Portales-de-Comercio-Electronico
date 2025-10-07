<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@bookhub.test'],
            [
                'name' => 'Admin BookHub',
                'password' => Hash::make('secret123'),
                'is_admin' => true,
            ]
        );

        // Standard user
        User::updateOrCreate(
            ['email' => 'usuario@bookhub.test'],
            [
                'name' => 'Usuario BookHub',
                'password' => Hash::make('secret123'),
                'is_admin' => false,
            ]
        );
    }
}
