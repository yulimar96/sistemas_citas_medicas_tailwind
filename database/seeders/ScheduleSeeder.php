<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::create(['name' => 'Horario de Atención General']);
        Schedule::create(['name' => 'Horario de Urgencias']);
        Schedule::create(['name' => 'Horario de Exámenes']);
        Schedule::create(['name' => 'Horario de Rehabilitación']);
        Schedule::create(['name' => 'Horario de Seguimiento']);
    }
}
