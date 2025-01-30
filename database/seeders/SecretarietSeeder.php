<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Secretariet;

class SecretarietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Secretariet::create([
            'name' => 'rebeca',
            'last_name' => 'perez',
            'email' => 'rebeca@gmail.com',
            'password' => bcrypt('123456789'),
            'address' => 'pastora',
            'birthdate' => '02/05/1996',
            'code_area' => '0412',
            'phone' => '091508',
            'status' => 'active',
        ]);
    }
}
