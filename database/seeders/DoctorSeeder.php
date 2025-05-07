<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {

        Doctor::create(['medical_license'=>'4644477',
        'schedule_id'=>1,
        'specialitys_id'=>1,
        'hire_date'=>'2022-05-02',
        'person_id'=>3,
        'employee_contract_types_id'=>1,
        'employee_type'=>'Doctor',
        'employee_position_id'=>1,
        'organizational_unit_types_id'=>1]);

    } 
}
