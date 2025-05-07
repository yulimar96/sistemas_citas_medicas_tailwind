<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FederalStates;

class FederalStateSeeder extends Seeder
{

    public function run(): void
    {
         FederalStates::create(['id' => 1, 'name' => 'Amazonas', 'iso_3166-2'=> 'VE-X' ]);
		 FederalStates::create(['id' => 2, 'name' => 'Anzoátegui', 'iso_3166-2'=> 'VE-B' ]);
		 FederalStates::create(['id' => 3, 'name' => 'Apure', 'iso_3166-2'=> 'VE-C' ]);
		 FederalStates::create(['id' => 4, 'name' => 'Aragua', 'iso_3166-2'=> 'VE-D' ]);
		 FederalStates::create(['id' => 5, 'name' => 'Barinas', 'iso_3166-2'=> 'VE-E' ]);
		 FederalStates::create(['id' => 6, 'name' => 'Bolívar', 'iso_3166-2'=> 'VE-F' ]);
		 FederalStates::create(['id' => 7, 'name' => 'Carabobo', 'iso_3166-2'=> 'VE-G' ]);
		 FederalStates::create(['id' => 8, 'name' => 'Cojedes', 'iso_3166-2'=> 'VE-H' ]);
		 FederalStates::create(['id' => 9, 'name' => 'Delta Amacuro', 'iso_3166-2'=> 'VE-Y' ]);
		 FederalStates::create(['id' => 10, 'name' => 'Falcón', 'iso_3166-2'=> 'VE-I' ]);
		 FederalStates::create(['id' => 11, 'name' => 'Guárico', 'iso_3166-2'=> 'VE-J' ]);
		 FederalStates::create(['id' => 12, 'name' => 'Lara', 'iso_3166-2'=> 'VE-K' ]);
		 FederalStates::create(['id' => 13, 'name' => 'Mérida', 'iso_3166-2'=> 'VE-L' ]);
		 FederalStates::create(['id' => 14, 'name' => 'Miranda', 'iso_3166-2'=> 'VE-M' ]);
		 FederalStates::create(['id' => 15, 'name' => 'Monagas', 'iso_3166-2'=> 'VE-N' ]);
		 FederalStates::create(['id' => 16, 'name' => 'Nueva Esparta', 'iso_3166-2'=> 'VE-O' ]);
		 FederalStates::create(['id' => 17, 'name' => 'Portuguesa', 'iso_3166-2'=> 'VE-P' ]);
		 FederalStates::create(['id' => 18, 'name' => 'Sucre', 'iso_3166-2'=> 'VE-R' ]);
		 FederalStates::create(['id' => 19, 'name' => 'Táchira', 'iso_3166-2'=> 'VE-S' ]);
		 FederalStates::create(['id' => 20, 'name' => 'Trujillo', 'iso_3166-2'=> 'VE-T' ]);
		 FederalStates::create(['id' => 21, 'name' => 'Vargas', 'iso_3166-2'=> 'VE-W' ]);
		 FederalStates::create(['id' => 22, 'name' => 'Yaracuy', 'iso_3166-2'=> 'VE-U' ]);
		 FederalStates::create(['id' => 23, 'name' => 'Zulia', 'iso_3166-2'=> 'VE-V' ]);
		 FederalStates::create(['id' => 24, 'name' => 'Distrito Capital', 'iso_3166-2'=> 'VE-A' ]);
		 FederalStates::create(['id' => 25, 'name' => 'Dependencias Federales', 'iso_3166-2'=> 'VE-Z' ]);
    }
}
