<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeeContractTypes;

class EmployeeContractTypeSeeder extends Seeder
{
    public function run(): void
    {
        EmployeeContractTypes::create([
            'name' => 'Contrato a Tiempo Completo',
            'description' => 'Contrato que requiere dedicación completa del empleado.',
            'headquarter_id' => 1 // Cambia este valor según tu base de datos
        ]);

        EmployeeContractTypes::create([
            'name' => 'Contrato a Tiempo Parcial',
            'description' => 'Contrato que requiere dedicación parcial del empleado.',
            'headquarter_id' => 1 // Cambia este valor según tu base de datos
        ]);

        EmployeeContractTypes::create([
            'name' => 'Contrato Temporal',
            'description' => 'Contrato con duración limitada a un periodo específico.',
            'headquarter_id' => 1 // Cambia este valor según tu base de datos
        ]);

        EmployeeContractTypes::create([
            'name' => 'Contrato Indefinido',
            'description' => 'Contrato sin fecha de finalización definida.',
            'headquarter_id' => 1 // Cambia este valor según tu base de datos
        ]);

        EmployeeContractTypes::create([
            'name' => 'Contrato por Proyecto',
            'description' => 'Contrato que se establece para la duración de un proyecto específico.',
            'headquarter_id' => 1 // Cambia este valor según tu base de datos
        ]);

        EmployeeContractTypes::create([
            'name' => 'Contrato de Prácticas',
            'description' => 'Contrato destinado a estudiantes o recién graduados para adquirir experiencia.',
            'headquarter_id' => 1 // Cambia este valor según tu base de datos
        ]);

        EmployeeContractTypes::create([
            'name' => 'Contrato de Aprendizaje',
            'description' => 'Contrato que combina la formación teórica y práctica.',
            'headquarter_id' => 1 // Cambia este valor según tu base de datos
        ]);

        EmployeeContractTypes::create([
            'name' => 'Contrato de Freelance',
            'description' => 'Contrato para trabajadores independientes que ofrecen sus servicios.',
            'headquarter_id' => 1 // Cambia este valor según tu base de datos
        ]);

        EmployeeContractTypes::create([
            'name' => 'Contrato de Teletrabajo',
            'description' => 'Contrato que permite al empleado trabajar desde su hogar.',
            'headquarter_id' => 1 // Cambia este valor según tu base de datos
        ]);

        EmployeeContractTypes::create([
            'name' => 'Contrato de Suministro de Servicios',
            'description' => 'Contrato para la prestación de servicios específicos.',
            'headquarter_id' => 1 // Cambia este valor según tu base de datos
        ]);

        EmployeeContractTypes::create([
            'name' => 'Contrato de Reemplazo',
            'description' => 'Contrato temporal para sustituir a un empleado ausente.',
            'headquarter_id' => 1 // Cambia este valor según tu base de datos
        ]);

    }
}
