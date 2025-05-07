<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Ejecuta los seeders de la base de datos.
     */
    public function run(): void
    {
        // Lista de permisos
        Permission::create(['name' => 'crear_usuarios']);
        Permission::create(['name' => 'ver_usuarios']);
        Permission::create(['name' => 'editar_usuarios']);
        Permission::create(['name' => 'eliminar_usuarios']);

        Permission::create(['name' => 'crear_secretaria']);
        Permission::create(['name' => 'ver_secretaria']);
        Permission::create(['name' => 'editar_secretaria']);
        Permission::create(['name' => 'eliminar_secretaria']);

        Permission::create(['name' => 'crear_doctor']);
        Permission::create(['name' => 'ver_doctor']);
        Permission::create(['name' => 'editar_doctor']);
        Permission::create(['name' => 'eliminar_doctor']);

        Permission::create(['name' => 'crear_paciente']);
        Permission::create(['name' => 'ver_paciente']);
        Permission::create(['name' => 'editar_paciente']);
        Permission::create(['name' => 'eliminar_paciente']);

        Permission::create(['name' => 'crear_horario_doctor']);
        Permission::create(['name' => 'ver_horario_doctor']);
        Permission::create(['name' => 'editar_horario_doctor']);
        Permission::create(['name' => 'eliminar_horario_doctor']);

        // Lista de roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleSecretaria = Role::create(['name' => 'secretaria']);
        $roleDoctor = Role::create(['name' => 'doctor']);
        $rolePaciente = Role::create(['name' => 'paciente']);
        
        // Usuario administrador
        $admin = User::create([
            'name' => 'Yulimar',
            'email' => 'yuli@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 'active',
        ]);
        $admin->assignRole($roleAdmin);
        $permissionAdmin = Permission::query()->pluck('name');
        $roleAdmin->syncPermissions($permissionAdmin);

        // Usuario secretaria
        $secretaria = User::create([
            'name' => 'Carmen',
            'email' => 'carmen@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 'active',
        ]);
        $secretaria->assignRole($roleSecretaria);
        $roleSecretaria->syncPermissions([
            'crear_doctor', 'ver_doctor', 'editar_doctor', 'eliminar_doctor',
            'crear_paciente', 'ver_paciente', 'editar_paciente', 'eliminar_paciente',
            'crear_horario_doctor', 'ver_horario_doctor', 'editar_horario_doctor', 'eliminar_horario_doctor'
        ]);

        // Usuario doctor
        $doctor = User::create([
            'name' => 'Elena',
            'email' => 'elena@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 'active',
        ]);
        $doctor->assignRole($roleDoctor);
        $roleDoctor->syncPermissions([
            'ver_horario_doctor'
        ]);

        // Usuario paciente 1
        $paciente1 = User::create([
            'name' => 'Marta',
            'email' => 'marta@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 'active',
        ]);
        $paciente1->assignRole($rolePaciente);
          $rolePaciente->syncPermissions([
            'ver_horario_doctor','ver_paciente'
        ]);


        // Usuario paciente 2
        $paciente2 = User::create([
            'name' => 'Carlos Pérez',
            'email' => 'carlos@example.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $paciente2->assignRole($rolePaciente);
        $rolePaciente->syncPermissions([
            'ver_horario_doctor','ver_paciente'
        ]);

               // Usuario paciente 2
        $paciente3 = User::create([
            'name' => 'pablo Pérez',
            'email' => 'pablo@example.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $paciente3->assignRole($rolePaciente);

        // Asignar permisos al rol paciente (se aplica a todos los pacientes)
        $rolePaciente->syncPermissions([
             'ver_horario_doctor','ver_paciente'
        ]);

                     // Usuario paciente 2
        $paciente4 = User::create([
            'name' => 'jose Pérez',
            'email' => 'jose@example.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $paciente4->assignRole($rolePaciente);
        $rolePaciente->syncPermissions([
           'ver_horario_doctor','ver_paciente'
        ]);
    }
}