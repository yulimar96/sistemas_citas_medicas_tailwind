<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Allergy;
use App\Models\Patient;
class AllergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
       public function run()
    {
        // Obtener todos los pacientes existentes
        $patients = Patient::all();

        // Definir las alergias
        $allergyTypes = [
            'Polen' => 'Reacción alérgica al polen de gramíneas',
            'Ácaros' => 'Reacción alérgica a los ácaros del polvo',
            'Alimentos' => 'Reacción alérgica a ciertos alimentos como nueces, mariscos, etc.',
            'Medicamentos' => 'Reacción alérgica a medicamentos como penicilina',
            'Picaduras de insectos' => 'Reacción alérgica a picaduras de abejas, avispas, etc.',
            'Moho' => 'Reacción alérgica a esporas de moho',
            'Pelo de animales' => 'Reacción alérgica al pelo de mascotas como gatos y perros',
        ];

        // Insertar alergias para cada paciente
        foreach ($patients as $patient) {
            foreach ($allergyTypes as $type => $description) {
                Allergy::create([
                    'patient_id' => $patient->id,
                    'allergy_type' => $type,
                    'description' => $description,
                ]);
            }
        }
    }
}

