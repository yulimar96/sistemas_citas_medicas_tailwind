<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persons;
class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Persons::create(['name_1'=>'Yulimar',
                          'surname_1'=>'Dominguez',
                          'sex'=>TRUE,
                          'birth_date'=>'1996-05-02',
                          'blood_type'=>'A+',
                          'nacionality'=>'V',
                          'identification_number'=>'24805826',
                           'phone_area_codes'=>0212,
                          'phone_number'=>'0941508',
                          'cell_phone_area_codes'=>0412,
                          'cellphone_number'=>'0941508',
                          'federals_state_id'=>1,
                          'municipalities_id'=>1,
                          'parish_id'=>1,
                          // 'cities_id'=>1,
                          'room_type'=>'home',
                        'level_of_education'=>'Ingeniera e sistema',
                        'user_id'=>1
                      ]);

         Persons::create(['name_1'=>'Carmen',
                          'surname_1'=>'Martinez',
                          'sex'=>TRUE,
                          'birth_date'=>'1996-05-02',
                          'blood_type'=>'A-',
                          'nacionality'=>'V',
                          'identification_number'=>'23576908',
                          'phone_area_codes'=>0212,
                          'phone_number'=>'0941508',
                          'cell_phone_area_codes'=>0412,
                          'cellphone_number'=>'0941508',
                          'federals_state_id'=>1,
                          'municipalities_id'=>1,
                          'parish_id'=>1,
                          // 'cities_id'=>1,
                        'room_type'=>'home',
                        'level_of_education'=>'Ingeniera e sistema',
                      'user_id'=>2]);

         Persons::create(['name_1'=>'Elena',
                        'surname_1'=>'Matos',
                       'sex'=>TRUE,
                       'birth_date'=>'1996-05-02',
                          'blood_type'=>'A+',
                          'nacionality'=>'V',
                        'identification_number'=>'25467890',
                        'phone_area_codes'=>0212,
                          'phone_number'=>'0941508',
                          'cell_phone_area_codes'=>0412,
                        'cellphone_number'=>'0941508',
                        'federals_state_id'=>1,
                        'municipalities_id'=>1,
                        'parish_id'=>1,
                        // 'cities_id'=>1,
                        'room_type'=>'home',
                        'level_of_education'=>'Ingeniera e sistema',
                      'user_id'=>3]);

         Persons::create(['name_1'=>'Marta',
                          'surname_1'=>'Rodriguez',
                           'sex'=>TRUE,
                          'birth_date'=>'1996-05-02',
                          'blood_type'=>'A+',
                          'nacionality'=>'V',
                          'identification_number'=>'25678754',
                           'phone_area_codes'=>0212,
                          'phone_number'=>'0941508',
                          'cell_phone_area_codes'=>0412,
                          'cellphone_number'=>'0941508',
                          'federals_state_id'=>1,
                          'municipalities_id'=>1,
                          'parish_id'=>1,
                          // 'cities_id'=>1,
                          'parish_id'=>1,
                        'room_type'=>'home',
                        'level_of_education'=>'Ingeniera e sistema',
                      'user_id'=>4]);

     Persons::create([
            'name_1' => 'Carlos',
            'surname_1' => 'Pérez',
            'sex' => true,
            'birth_date' => '1985-03-15',
            'blood_type' => 'O-',
            'nacionality' => 'V',
            'identification_number' => '12345678',
            'phone_area_codes' => '0212',
            'phone_number' => '1234567',
            'cell_phone_area_codes' => '0412',
            'cellphone_number' => '7654321',
            'federals_state_id' => 1,
            'municipalities_id' => 1,
            'parish_id' => 1,
            'room_type' => 'home',
            'level_of_education' => 'Licenciado en administración',
            'user_id' => 5,
        ]);

        Persons::create([
            'name_1' => 'María',
            'surname_1' => 'González',
            'sex' => false,
            'birth_date' => '1990-07-20',
            'blood_type' => 'B+',
            'nacionality' => 'V',
            'identification_number' => '98765432',
            'phone_area_codes' => '0212',
            'phone_number' => '2345678',
            'cell_phone_area_codes' => '0412',
            'cellphone_number' => '8765432',
            'federals_state_id' => 1,
            'municipalities_id' => 1,
            'parish_id' => 1,
            'room_type' => 'home',
            'level_of_education' => 'Licenciada en medicina',
            'user_id' => 6,
        ]);

        Persons::create([
            'name_1' => 'José',
            'surname_1' => 'Martínez',
            'sex' => true,
            'birth_date' => '1988-11-30',
            'blood_type' => 'AB+',
            'nacionality' => 'V',
            'identification_number' => '11223344',
            'phone_area_codes' => '0212',
            'phone_number' => '3456789',
            'cell_phone_area_codes' => '0412',
            'cellphone_number' => '9876543',
            'federals_state_id' => 1,
            'municipalities_id' => 1,
            'parish_id' => 1,
            'room_type' => 'home',
            'level_of_education' => 'Ingeniero civil',
            'user_id' => 7,
        ]);
}
}