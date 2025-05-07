<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Patient,
    Employee,
    DoctorSchedule,
    OrganizationalUnit
};


class WelcomeController extends Controller
{
    public function index()
{
    // $employeeCounts = Employee::selectRaw('
    //     SUM(CASE WHEN employee_type = "Doctor" THEN 1 ELSE 0 END) as doctors_count,
    //     SUM(CASE WHEN employee_type = "Secretary" THEN 1 ELSE 0 END) as secretariat_count
    // ')->first();

    // return view('welcome', [
    //     'users' => $this->getActiveUsersCount(),
    //     'doctors' => $employeeCounts->doctors_count,
    //     'patients' => $this->getActivePatientsCount(),
    //     'secretariat' => $employeeCounts->secretariat_count,
    //     'doctorschedule' => $this->getActiveDoctorSchedulesCount(),
    //     'organizationalunit' => $this->getActiveOrganizationalUnitsCount()
    // ]);
}
}
