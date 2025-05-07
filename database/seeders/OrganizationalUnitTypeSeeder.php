<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrganizationalUnitTypes;

class OrganizationalUnitTypeseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrganizationalUnitTypes::create(['name' => 'Pediatría', 'headquarter_id' => 1, 'description' => 'Atención médica especializada para niños desde recién nacidos hasta adolescentes.', 'status' => 'active']);
        OrganizationalUnitTypes::create(['name' => 'Medicina General', 'headquarter_id' => 1, 'description' => 'Primer nivel de atención médica para diagnóstico y tratamiento de enfermedades comunes', 'status' => 'active']);
        OrganizationalUnitTypes::create(['name' => 'Ginecología y Obstetricia', 'headquarter_id' => 2, 'description' => 'Atención especializada en salud femenina y embarazos', 'status' => 'active']);
        OrganizationalUnitTypes::create(['name' => 'Cardiología', 'headquarter_id' => 2, 'description' => 'Diagnóstico y tratamiento de enfermedades del corazón', 'status' => 'active']);
        OrganizationalUnitTypes::create(['name' => 'Traumatología', 'headquarter_id' => 2, 'description' => 'Especialidad en lesiones del sistema musculoesquelético', 'status' => 'active']);

    }
}
