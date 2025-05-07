<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrganizationalUnit;

class OrganizationalUnitSeeder extends Seeder
{
    public function run(): void
    {
        OrganizationalUnit::create([
            'name' => 'Consulta Externa de Pediatría',
            'ability' => 5,
            'since' => '2025-03-11',
            'phone_area_codes' => '123',
            'phone_number' => '4567890',
            'specialitys' => 'Medicina General',
            'location'=>'Piso 1, Ala Norte',
            'organizational_unit_types_id' => 1, 
            'description' => 'Institución médica que proporciona atención médica completa.',
            'status' => 'active'
        ]);

        OrganizationalUnit::create([
            'name' => 'Consulta de Medicina General',
            'ability' => 2,
            'since' => '2025-03-11',
            'phone_area_codes' => '123',
            'phone_number' => '4567891',
            'specialitys' => 'Medicina General',
            'location'=>'Piso 2, Ala Central',
            'organizational_unit_types_id' => 1,
            'description' => 'Consultorios para atención pediátrica general',
            'status' => 'active'
        ]);

        OrganizationalUnit::create([
            'name' => 'Laboratorio Clínico Central',
            'ability' => 10,
            'since' => '2025-03-11',
            'phone_area_codes' => '123',
            'phone_number' => '4567892',
            'specialitys' => 'Medicina Familiar',
            'location'=>'Piso B1',
            'organizational_unit_types_id' => 1,
            'description' => 'Primera consulta y seguimiento de pacientes adultos',
            'status' => 'active'
        ]);

        OrganizationalUnit::create([
            'name' => 'Consultorio Médico',
            'ability' => 5,
            'since' => '2025-03-11',
            'phone_area_codes' => '123',
            'phone_number' => '4567893',
            'specialitys' => 'Medicina General',
            'location'=>'676',
            'organizational_unit_types_id' => 1,
            'description' => 'Toma de muestras y análisis clínicos',
            'status' => 'active'
        ]);

        OrganizationalUnit::create([
            'name' => 'Unidad de Cardiología',
            'ability' => '7',
            'since' => '2025-03-11',
            'phone_area_codes' => '123',
            'phone_number' => '4567894',
            'location'=>'Piso 1, Ala Norte',
            'specialitys' => 'Laboratorio',
            'organizational_unit_types_id' => 1,
            'description' => 'Consultorios y pruebas cardiológicas especializadas',
            'status' => 'active'
        ]);

        OrganizationalUnit::create([
            'name' => 'Centro de Rehabilitación',
            'ability' => 'Rehabilitación física',
            'since' => '2025-03-11',
            'phone_area_codes' => '123',
            'phone_number' => '4567895',
            'specialitys' => 'Rehabilitación',
            'location'=>'676',
            'organizational_unit_types_id' => 1,
            'description' => 'Institución que ofrece servicios de rehabilitación física.',
            'status' => 'active'
        ]);
    }
}