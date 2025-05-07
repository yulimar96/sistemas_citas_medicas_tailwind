<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CellPhoneAreaCode;

class CellPhoneAreaCodeSeeder extends Seeder
{

    public function run()
    {
    $CellPhoneAreaCodes = [
    ['code' => '412', 'description' => 'Digitel'],
    ['code' => '416', 'description' => 'Digitel'],
    ['code' => '426', 'description' => 'Movilnet'],
    ['code' => '424', 'description' => 'Movistar'],
    ['code' => '414', 'description' => 'Movistar'],

];

foreach ($CellPhoneAreaCodes as $CellPhoneAreaCode) {
    CellPhoneAreaCode::create($CellPhoneAreaCode);
}

}

}
