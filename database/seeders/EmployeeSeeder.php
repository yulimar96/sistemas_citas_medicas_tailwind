<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee; // Asegúrate de importar el modelo Employee
use App\Models\Persons; // Asegúrate de importar el modelo Person
use App\Models\Schedule; // Asegúrate de importar el modelo Schedule
use App\Models\MedicalSpeciality; // Asegúrate de importar el modelo MedicalSpeciality
use App\Models\EmployeeContractTypes; // Asegúrate de importar el modelo EmployeeContractType
use App\Models\EmployeePosition; // Asegúrate de importar el modelo EmployeePosition
use App\Models\OrganizationalUnitTypes; // Asegúrate de importar el modelo OrganizationalUnitType

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Asegúrate de que los registros necesarios existan en las tablas relacionadas
        $person = Persons::first(); // Obtén un registro de la tabla peoples
        $schedule = Schedule::first(); // Obtén un registro de la tabla schedules
        $medicalSpeciality = MedicalSpeciality::first(); // Obtén un registro de la tabla medical_specialities
        $contractType = EmployeeContractTypes::first(); // Obtén un registro de la tabla employee_contract_types
        $position = EmployeePosition::first(); // Obtén un registro de la tabla employee_positions
        $organizationalUnitType = OrganizationalUnitTypes::first(); // Obtén un registro de la tabla organizational_unit_types

        // Crear registros en la tabla employees
        Employee::create([
            'person_id' => $person ? $person->id : null, // Asigna el ID de la persona o null
            'employee_type' => 'Doctor', // O 'part-time', según sea necesario
            'hire_date' => now(), // Fecha de contratación actual
            'schedule_id' => $schedule ? $schedule->id : null, // Asigna el ID del horario o null
            'medical_license' => 'ML123456', // Ejemplo de licencia médica
            'specialitys_id' => $medicalSpeciality ? $medicalSpeciality->id : null, // Asigna el ID de la especialidad médica o null
            'employee_contract_types_id' => $contractType ? $contractType->id : null, // Asigna el ID del tipo de contrato o null
            'employee_position_id' => $position ? $position->id : null, // Asigna el ID de la posición o null
            'organizational_unit_types_id' => $organizationalUnitType ? $organizationalUnitType->id : null, // Asigna el ID del tipo de unidad organizativa o null
            'status' => 'active', // Estado por defecto
        ]);
    }
}
