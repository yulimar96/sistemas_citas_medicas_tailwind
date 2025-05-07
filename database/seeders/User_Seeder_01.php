<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $roles = [
            'admin',
            'secretariat',
            'doctor',
            'pacient',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

  // Roles
        $roles = [
            'admin',
            'secretaria', // Cambié 'secretariat' a 'secretaria' para consistencia
            'doctor',
            'paciente',
            'user' // Cambié 'pacient' a 'paciente' para consistencia
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Crear permisos para usuarios
        Permission::create(['name' => 'user'])->syncRoles(['admin']);
        Permission::create(['name' => 'user.create'])->syncRoles(['admin']);
        Permission::create(['name' => 'user.show'])->syncRoles(['admin']);
        Permission::create(['name' => 'user.update'])->syncRoles(['admin']);
        Permission::create(['name' => 'user.delete'])->syncRoles(['admin']);
        Permission::create(['name' => 'user.reset'])->syncRoles(['admin']);

        // Crear permisos para empleados
        Permission::create(['name' => 'employee'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'employee.create'])->syncRoles(['admin']);
        Permission::create(['name' => 'employee.update'])->syncRoles(['admin']);
        Permission::create(['name' => 'employee.delete'])->syncRoles(['admin']);

        // Crear permisos para secretarias
        Permission::create(['name' => 'secretariat'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'secretariat.create'])->syncRoles(['admin']);
        Permission::create(['name' => 'secretariat.update'])->syncRoles(['admin']);
        Permission::create(['name' => 'secretariat.delete'])->syncRoles(['admin']);

        // Crear permisos para doctores
        Permission::create(['name' => 'doctor'])->syncRoles(['admin','secretaria']);
        Permission::create(['name' => 'doctor.create'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'doctor.update'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'doctor.delete'])->syncRoles(['admin', 'secretaria']);

        // Crear permisos para pacientes
        Permission::create(['name' => 'patient'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'patient.create'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'patient.update'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'patient.delete'])->syncRoles(['admin', 'secretaria']);

        // Crear permisos para horarios
        Permission::create(['name' => 'schedule'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'schedule.create'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'schedule.update'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'schedule.delete'])->syncRoles(['admin', 'secretaria']);

        // Crear permisos para horarios de doctores
        Permission::create(['name' => 'doctor_schedule'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'doctor_schedule.create'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'doctor_schedule.update'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'doctor_schedule.delete'])->syncRoles(['admin', 'secretaria']);

        // Crear permisos para sedes
        Permission::create(['name' => 'headquarter'])->syncRoles(['admin']);
        Permission::create(['name' => 'headquarter.create'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'headquarter.update'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'headquarter.delete'])->syncRoles(['admin', 'secretaria']);

        // Crear permisos para tipos de unidades
        Permission::create(['name' => 'unit_type'])->syncRoles(['admin']);
        Permission::create(['name' => 'unit_type.create'])->syncRoles(['admin']);
        Permission::create(['name' => 'unit_type.update'])->syncRoles(['admin']);
        Permission::create(['name' => 'unit_type.delete'])->syncRoles(['admin']);

        // Crear permisos para unidades organizacionales
        Permission::create(['name' => 'unit'])->syncRoles(['admin']);
        Permission::create(['name' => 'unit.create'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'unit.update'])->syncRoles(['admin', 'secretaria']);
        Permission::create(['name' => 'unit.delete'])->syncRoles(['admin', 'secretaria']);

    

        // Crear usuarios
        $adminUser = User::create([
            'name' => 'Yulimar',
            'email' => 'yuli@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 'active',
        ]);
        $adminUser->assignRole('admin');

        $secretariatUser = User::create([
            'name' => 'Carmen',
            'email' => 'carmen@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 'active',
        ]);
        $secretariatUser->assignRole('secretariat');

        $doctorUser = User::create([
            'name' => 'Elena',
            'email' => 'elena@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 'active',
        ]);
        $doctorUser->assignRole('doctor');

        // Otros usuarios
        User::create([
            'name' => 'Marta',
            'email' => 'marta@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 'active',
        ])->assignRole('pacient');

        User::create([
            'name' => 'Carlos Pérez',
            'email' => 'carlos@example.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ])->assignRole('pacient');

        User::create([
            'name' => 'María González',
            'email' => 'maria@example.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ])->assignRole('pacient');

        User::create([
            'name' => 'José Martínez',
            'email' => 'jose@example.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ])->assignRole('pacient');
    }
}