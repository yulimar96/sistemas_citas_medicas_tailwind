<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    Patient,
    Employee,
    DoctorSchedule,
    OrganizationalUnit,
    Event
};

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard principal con estadísticas del sistema.
     *
     * @return \Illuminate\View\View
     */
   public function index()
{
    $employeeCounts = Employee::selectRaw('
        SUM(CASE WHEN employee_type = "Doctor" THEN 1 ELSE 0 END) as doctors_count,
        SUM(CASE WHEN employee_type = "Secretary" THEN 1 ELSE 0 END) as secretariat_count
    ')->first();
    $events = Event::where('status','pendiente')->count();

    return view('dashboard', [
        'users' => $this->getActiveUsersCount(),
        'doctors' => $employeeCounts->doctors_count,
        'patients' => $this->getActivePatientsCount(),
        'secretariat' => $employeeCounts->secretariat_count,
        'doctorschedule' => $this->getActiveDoctorSchedulesCount(),
        'organizationalunit' => $this->getActiveOrganizationalUnitsCount(),
        'events' => $events
    ]);
}

    /**
     * Obtiene el conteo de usuarios activos
     * 
     * @return int
     */
    protected function getActiveUsersCount(): int
    {
        return User::where('status', 'active')->count();
    }

    /**
     * Obtiene el conteo de doctores activos
     * 
     * @return int
     */
    protected function getActiveDoctorsCount(): int
    {
        return Doctor::where('employee_type', 'doctor')
                   ->where('status', 'active')
                   ->count();
    }

    /**
     * Obtiene el conteo de pacientes activos
     * 
     * @return int
     */
    protected function getActivePatientsCount(): int
    {
        return Patient::where('status', 'active')->count();
    }

    /**
     * Obtiene el conteo de personal de secretaría
     * 
     * @return int
     */
    protected function getSecretariatCount(): int
    {
        return Secretariat::where('employee_type', 'secretariat')->count();
    }

    /**
     * Obtiene el conteo de horarios médicos activos
     * 
     * @return int
     */
    protected function getActiveDoctorSchedulesCount(): int
    {
        return DoctorSchedule::where('status', 'active')->count();
    }

    /**
     * Obtiene el conteo de unidades organizacionales activas
     * 
     * @return int
     */
    protected function getActiveOrganizationalUnitsCount(): int
    {
        return OrganizationalUnit::where('status', 'active')->count();
    }
}