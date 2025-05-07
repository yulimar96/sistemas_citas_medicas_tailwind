<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ScheduleDetail; 
class ScheduleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScheduleDetail::create(['day' => 'Lunes', 'start_time' => '08:00:00', 'closing_time' => '17:00:00', 'schedule_id' => 1]);
        ScheduleDetail::create(['day' => 'Martes', 'start_time' => '08:00:00', 'closing_time' => '17:00:00', 'schedule_id' => 1]);
        ScheduleDetail::create(['day' => 'Miercoles', 'start_time' => '08:00:00', 'closing_time' => '17:00:00', 'schedule_id' => 1]);
        ScheduleDetail::create(['day' => 'Jueves', 'start_time' => '08:00:00', 'closing_time' => '17:00:00', 'schedule_id' => 1]);
        ScheduleDetail::create(['day' => 'Viernes', 'start_time' => '08:00:00', 'closing_time' => '17:00:00', 'schedule_id' => 1]);
        
        ScheduleDetail::create(['day' => 'Lunes', 'start_time' => '17:00:00', 'closing_time' => '20:00:00', 'schedule_id' => 2]);
        ScheduleDetail::create(['day' => 'Martes', 'start_time' => '17:00:00', 'closing_time' => '20:00:00', 'schedule_id' => 2]);
        ScheduleDetail::create(['day' => 'Miercoles', 'start_time' => '17:00:00', 'closing_time' => '20:00:00', 'schedule_id' => 2]);
        ScheduleDetail::create(['day' => 'Jueves', 'start_time' => '17:00:00', 'closing_time' => '20:00:00', 'schedule_id' => 2]);
        ScheduleDetail::create(['day' => 'Viernes', 'start_time' => '17:00:00', 'closing_time' => '20:00:00', 'schedule_id' => 2]);
    }
}
