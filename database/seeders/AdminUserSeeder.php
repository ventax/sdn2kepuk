<?php

use App\Models\User;

User::create([
    'name' => 'Admin SDN 2 Kepuk',
    'email' => 'sdn2kepukbangsri@gmail.com',
    'password' => bcrypt('sdnkepuk123'),
]);
