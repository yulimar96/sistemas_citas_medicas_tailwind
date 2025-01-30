<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'yulimar',
            'email' => 'yuli@gmail.com',
            'password' => bcrypt('123456789'),// ID de la persona Yulimar
           // ID de la persona Yulimar
           'status' => 'active',
        ]);
    }
}
