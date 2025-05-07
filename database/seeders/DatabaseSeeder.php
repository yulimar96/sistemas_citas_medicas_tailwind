<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([OrganizationSeeder::class]);
        $this->call([HeadquarterSeeder::class]);
        $this->call([OrganizationalUnitTypeSeeder::class]);
        $this->call([ OrganizationalUnitSeeder::class,
        ScheduleSeeder::class,
        ScheduleDetailSeeder::class,
       
    ]);
        $this->call([CellPhoneAreaCodeSeeder::class]);
        $this->call([EmployeePositionSeeder::class]);
       
        $this->call([EmployeeContractTypeSeeder::class]);
        
        $this->call([FederalStateSeeder::class]);
        $this->call([CitiesSeeder::class]);

        $this->call([MedicalSpecialitieSeeder::class]);
        $this->call([MunicipalitiesSeeder::class]);
        $this->call([ParishSeeder::class]);
        $this->call([PhoneAreaCodeSeeder::class]);

        // $this->call([RoleSeeder::class]);
        // $this->call([PermissionSeeder::class]);
       
        $this->call([UserSeeder::class]);
        $this->call([PersonSeeder::class]);
        $this->call([PatientSeeder::class]);
         $this->call([EmployeeSeeder::class]);

        $this->call([AllergySeeder::class]);
        $this->call([SecretariatSeeder::class]);
        $this->call([OrganizationalUnitMembersSeeder::class]);
        // $this->call([MigrateLeadersSeeder::class]);
    }
}
