<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeePosition; // Asegúrate de importar el modelo correspondiente
use App\Models\OrganizationalUnit; // Asegúrate de importar el modelo correspondiente

class MigrateLeadersSeeder extends Seeder
{
    public function run()
    {
        $gerentePositionId = EmployeePosition::where('name', 'Gerente')->value('id');
        
        OrganizationalUnit::with(['members' => function($q) use ($gerentePositionId) {
            $q->where('employee_position_id', $gerentePositionId);
        }])->chunk(100, function($units) {
            foreach ($units as $unit) {
                if ($unit->members->isNotEmpty()) {
                    $unit->assignLeader($unit->members->first());
                }
            }
        });
    }
}