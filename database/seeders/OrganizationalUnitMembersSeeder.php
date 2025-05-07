<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeePosition;

class OrganizationalUnitMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('organizational_unit_members')
        ->whereIn('employee_id', function($query) {
            $query->select('id')
                  ->from('employees')
                  ->where('employee_position_id', EmployeePosition::where('name', 'Gerente')->value('id'));
        })
        ->update([
            'is_leader' => true,
            'start_date' => now()->subYear(),
            'updated_at' => now()
        ]);
    }
}
