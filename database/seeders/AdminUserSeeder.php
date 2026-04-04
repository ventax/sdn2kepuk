<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed a default admin user.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'sdn2kepukbangsri@gmail.com'],
            [
                'name' => 'Admin SDN 2 Kepuk',
                'password' => Hash::make('sdnkepuk123'),
            ]
        );
    }
}
