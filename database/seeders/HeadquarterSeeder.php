<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Headquarter;

class HeadquarterSeeder extends Seeder
{
    public function run(): void
    {
        Headquarter::create(['organizational_id'=>1,'name' => 'Clínica Salud Total', 'address' => 'Av. Principal 123, Ciudad']);
        Headquarter::create(['organizational_id'=>1,'name' => 'Clínica Salud Norte', 'address' => 'Av. Secundaria 456, Ciudad']);
}
}
