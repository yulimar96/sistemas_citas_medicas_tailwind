<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class SecretariatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
        'person_id'=>2,
        'employee_type'=>'Secretaria',
        'hire_date'=>'2022-05-02',
        'employee_contract_types_id'=>1,
        'employee_position_id'=>1,
        'organizational_unit_types_id'=>1]);
    }
}
