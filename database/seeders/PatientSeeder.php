<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
//    public function run()
// {
//    ; //  Patient::factory()->count(10)->create()Crea 10 pacientes
// }
    public function run(): void
    {
        Patient::create([ 
            'person_id'=>4,
            'medical_history'=>'4747',
            'registration_date'=>now(),
            'last_visit'=>now(),
            'has_allergies'=>false,
            'observation'=>'ninguna',
           
        ]);
        Patient::create(['person_id' => 5, 'medical_history' => 'Historia 1', 'registration_date' => now(), 'last_visit' => now(), 'status' => 'active']);
        Patient::create(['person_id' => 6, 'medical_history' => 'Historia 2', 'registration_date' => now(), 'last_visit' => now(), 'status' => 'active']);
        Patient::create(['person_id' => 7, 'medical_history' => 'Historia 3', 'registration_date' => now(), 'last_visit' => now(), 'status' => 'active']);
    }
}