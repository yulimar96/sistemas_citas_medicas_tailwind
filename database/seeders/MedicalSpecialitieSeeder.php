<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MedicalSpeciality;

class MedicalSpecialitieSeeder extends Seeder
{
    public function run(): void
    {
        MedicalSpeciality::create([
            'name' => 'Medicina General',
            'description' => 'Especialidad que se encarga de la atención integral del paciente, abordando diversas condiciones de salud.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Pediatría',
            'description' => 'Especialidad dedicada al diagnóstico y tratamiento de enfermedades en niños y adolescentes.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Ginecología',
            'description' => 'Especialidad que se ocupa de la salud de la mujer, incluyendo el sistema reproductivo y los problemas relacionados.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Oftalmología',
            'description' => 'Especialidad que se centra en el diagnóstico y tratamiento de enfermedades del ojo y la visión.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Otorrinolaringología',
            'description' => 'Especialidad que trata enfermedades del oído, nariz y garganta.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Dermatología',
            'description' => 'Especialidad que se ocupa del diagnóstico y tratamiento de enfermedades de la piel, cabello y uñas.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Cardiología',
            'description' => 'Especialidad dedicada al diagnóstico y tratamiento de enfermedades del corazón y el sistema circulatorio.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Neumología',
            'description' => 'Especialidad que se centra en el diagnóstico y tratamiento de enfermedades respiratorias y del sistema pulmonar.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Gastroenterología',
            'description' => 'Especialidad que se ocupa del diagnóstico y tratamiento de enfermedades del sistema digestivo.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Endocrinología',
            'description' => 'Especialidad que se dedica al estudio y tratamiento de trastornos hormonales y metabólicos.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Neurología',
            'description' => 'Especialidad que se ocupa del diagnóstico y tratamiento de enfermedades del sistema nervioso.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Psiquiatría',
            'description' => 'Especialidad que se centra en el diagnóstico y tratamiento de trastornos mentales y emocionales.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Oncología',
            'description' => 'Especialidad dedicada al diagnóstico y tratamiento del cáncer.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Radiología',
            'description' => 'Especialidad que utiliza técnicas de imagen para diagnosticar y tratar enfermedades.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Anestesiología',
            'description' => 'Especialidad que se encarga de la administración de anestesia y el manejo del dolor durante procedimientos quirúrgicos.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Cirugía General',
            'description' => 'Especialidad que se ocupa de realizar intervenciones quirúrgicas para tratar diversas condiciones médicas.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Cirugía Cardiaca',
            'description' => 'Especialidad que se enfoca en procedimientos quirúrgicos del corazón y grandes vasos.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Cirugía Ortopédica',
            'description' => 'Especialidad que se dedica al diagnóstico y tratamiento quirúrgico de lesiones y enfermedades del sistema musculoesquelético.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Cirugía Plástica',
            'description' => 'Especialidad que se ocupa de la reconstrucción y mejora estética de diferentes partes del cuerpo.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Urología',
            'description' => 'Especialidad que se centra en el diagnóstico y tratamiento de enfermedades del sistema urinario y reproductor masculino.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Reumatología',
            'description' => 'Especialidad que se ocupa del diagnóstico y tratamiento de enfermedades reumáticas y autoinmunitarias.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Infectología',
            'description' => 'Especialidad que se dedica al diagnóstico y tratamiento de enfermedades infecciosas.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Medicina Interna',
            'description' => 'Especialidad que se centra en el diagnóstico y tratamiento de enfermedades en adultos, abarcando múltiples sistemas del cuerpo.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Medicina Familiar',
            'description' => 'Especialidad que proporciona atención integral y continua a individuos y familias, abordando una amplia gama de problemas de salud.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Terapia Física',
            'description' => 'Especialidad que se enfoca en la rehabilitación y mejora de la movilidad a través de ejercicios y tratamientos físicos.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Nutriología',
            'description' => 'Especialidad que se ocupa del estudio de la nutrición y su impacto en la salud y el bienestar.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Medicina del Deporte',
            'description' => 'Especialidad que se centra en la prevención y tratamiento de lesiones relacionadas con la actividad física y el deporte.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Medicina del Trabajo',
            'description' => 'Especialidad que se ocupa de la salud de los trabajadores y la prevención de enfermedades laborales.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Paliativos',
            'description' => 'Especialidad que se enfoca en el cuidado de pacientes con enfermedades terminales, mejorando su calidad de vida.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Genética Médica',
            'description' => 'Especialidad que se ocupa del diagnóstico y tratamiento de enfermedades genéticas y hereditarias.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Geriatría',
            'description' => 'Especialidad que se centra en la atención médica de personas mayores, abordando sus necesidades específicas de salud.'
        ]);
        MedicalSpeciality::create([
            'name' => 'Medicina Estética',
            'description' => 'Especialidad que se ocupa de mejorar la apariencia física a través de tratamientos médicos y quirúrgicos.'
        ]);
    }
}
