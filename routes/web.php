<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SecretariatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorSchedulesController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationalUnitController;
use App\Http\Controllers\HeadquartersController;
use App\Http\Controllers\OrganizationalUnitTypeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');




Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'can:ver_usuarios'])->prefix('user')->group(function () {
    Route::get('/inicio', [UserController::class, 'index'])->name('user');
    Route::post('/perfil', [UserController::class, 'store'])->name('user.store');
    Route::get('/mostrar/{id}', [UserController::class, 'show'])->name('usuarios.show');
    Route::patch('/actualizar/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/resetear/{id}', [UserController::class, 'resetear'])->name('usuarios.resetear');
    Route::delete('/eliminar/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/{id}', [UserController::class, 'getUser']);
});
Route::middleware('auth')->prefix('employee')->group(function () {
    Route::get('/inicio', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/perfil', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/mostrar/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::patch('/actualizar/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::post('/resetear/{id}', [EmployeeController::class, 'resetear'])->name('employee.resetear');
    Route::delete('/eliminar/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

});
Route::middleware('auth')->prefix('secretariat')->group(function () {
    Route::get('/inicio', [SecretariatController::class, 'index'])->name('secretariat');
    Route::post('/perfil', [SecretariatController::class, 'store'])->name('secretariat.store');
    Route::get('/mostrar/{id}', [SecretariatController::class, 'show'])->name('secretariat.show');
    Route::patch('/actualizar/{id}', [SecretariatController::class, 'update'])->name('secretariat.update');
    Route::post('/resetear/{id}', [SecretariatController::class, 'resetear'])->name('secretariat.resetear');
    Route::delete('/eliminar/{id}', [SecretariatController::class, 'destroy'])->name('secretariat.destroy');

});
Route::middleware('auth')->prefix('doctor')->group(function () {
    Route::get('/inicio', [DoctorController::class, 'index'])->name('doctor');
    Route::post('/perfil', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('/mostrar/{id}', [DoctorController::class, 'show'])->name('doctor.show');
    Route::patch('/actualizar/{id}', [DoctorController::class, 'update'])->name('doctor.update');
    Route::post('/resetear/{id}', [DoctorController::class, 'resetear'])->name('doctor.resetear');
    Route::delete('/eliminar/{id}', [DoctorController::class, 'destroy'])->name('doctor.destroy');
});
Route::middleware('auth')->prefix('paciente')->group(function () {
    Route::get('/inicio', [PatientController::class, 'index'])->name('patient');
    Route::post('/perfil', [PatientController::class, 'store'])->name('patient.store');
    Route::get('/mostrar/{id}', [PatientController::class, 'show'])->name('patient.show');
    Route::patch('/actualizar/{id}', [PatientController::class, 'update'])->name('patient.update');
    Route::post('/resetear/{id}', [PatientController::class, 'resetear'])->name('patient.resetear');
    Route::delete('/eliminar/{id}', [PatientController::class, 'destroy'])->name('patient.destroy');

});

Route::middleware('auth')->prefix('schedule')->group(function () {
    Route::get('/inicio', [ScheduleController::class, 'index'])->name('schedule');
    Route::post('/perfil', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/mostrar/{id}', [ScheduleController::class, 'show'])->name('schedule.show');
    Route::patch('/actualizar/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::post('/resetear/{id}', [ScheduleController::class, 'resetear'])->name('schedule.resetear');
    Route::delete('/eliminar/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

});
Route::middleware('auth')->prefix('schedules')->group(function () {
    Route::get('/inicio', [DoctorSchedulesController::class, 'index'])->name('doctor_schedule');
    Route::post('/guardar', [DoctorSchedulesController::class, 'store'])->name('doctor_schedule.store');
    Route::get('/mostrar/{id}', [DoctorSchedulesController::class, 'show'])->name('doctor_schedule.show');
    Route::patch('/actualizar/{id}', [DoctorSchedulesController::class, 'update'])->name('doctor_schedule.update');
    Route::post('/resetear/{id}', [DoctorSchedulesController::class, 'resetear'])->name('doctor_schedule.resetear');
    Route::delete('/eliminar/{id}', [DoctorSchedulesController::class, 'destroy'])->name('doctor_schedule.destroy');
    Route::get('/{id}', [DoctorSchedulesController::class, 'getSchedule']);
    Route::get('/upload/{id}', [DoctorSchedulesController::class, 'upload'])->name('upload');
});
Route::get('/Organization', [OrganizationController::class, 'index'])->name('organization');
Route::post('/Guardar', [OrganizationController::class, 'store'])->name('organization.store');
Route::get('/Mostrar/{id}', [OrganizationController::class, 'show'])->name('organization.show');
Route::get('/Organizaciones', [OrganizationController::class, 'index'])->name('organization.index');
Route::patch('/Actualizar/{id}', [OrganizationController::class, 'update'])->name('organization.update');
Route::delete('/Eliminar/{id}', [OrganizationController::class, 'destroy'])->name('organization.destroy');
Route::get('/organization/data/{id}', [OrganizationController::class, 'getOrganizationData'])->name('organization.data');

// Rutas para gestionar sedes


Route::middleware('auth')->prefix('headquarters')->group(function () {
    Route::get('/inicio', [HeadquartersController::class, 'index'])->name('headquarter');
    Route::post('/perfil', [HeadquartersController::class, 'store'])->name('headquarter.store');
    Route::get('/mostrar/{id}', [HeadquartersController::class, 'show'])->name('headquarter.show');
    Route::patch('/actualizar/{id}', [HeadquartersController::class, 'update'])->name('headquarter.update');
    Route::post('/resetear/{id}', [HeadquartersController::class, 'resetear'])->name('headquarter.resetear');
    Route::delete('/eliminar/{id}', [HeadquartersController::class, 'destroy'])->name('headquarter.destroy');

});
Route::middleware('auth')->prefix('tipos_unidades')->group(function () {
    Route::get('/inicio', [OrganizationalUnitTypeController::class, 'index'])->name('unit_type');
    Route::post('/perfil', [OrganizationalUnitTypeController::class, 'store'])->name('unit_type.store');
    Route::get('/mostrar/{id}', [OrganizationalUnitTypeController::class, 'show'])->name('unit_type.show');
    Route::patch('/actualizar/{id}', [OrganizationalUnitTypeController::class, 'update'])->name('unit_type.update');
    Route::post('/resetear/{id}', [OrganizationalUnitTypeController::class, 'resetear'])->name('unit_type.resetear');
    Route::delete('/eliminar/{id}', [OrganizationalUnitTypeController::class, 'destroy'])->name('unit_type.destroy');

});

Route::middleware('auth')->prefix('organizational-units')->group(function () {
    Route::get('/inicio', [OrganizationalUnitController::class, 'index'])->name('unit');
    Route::post('/perfil', [OrganizationalUnitController::class, 'store'])->name('unit.store');
    Route::get('/mostrar/{id}', [OrganizationalUnitController::class, 'show'])->name('unit.show');
    Route::patch('/actualizar/{id}', [OrganizationalUnitController::class, 'update'])->name('unit.update');
    Route::post('/resetear/{id}', [OrganizationalUnitController::class, 'resetear'])->name('unit.resetear');
    Route::delete('/eliminar/{id}', [OrganizationalUnitController::class, 'destroy'])->name('unit.destroy');

});
Route::middleware('auth')->prefix('citas')->group(function () {
    Route::get('/inicio', [AppointmentController::class, 'index'])->name('appointments');
    Route::post('/Evento', [AppointmentController::class, 'store'])->name('appointments.event');
    Route::delete('/eliminar/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::patch('/appointments/{id}/cancel', [AppointmentController::class, 'cancel'])
     ->name('appointments.cancel');

Route::get('/appointments/archived', [AppointmentController::class, 'archived'])
     ->name('appointments.archived');
      Route::get('/upload/{id}', [AppointmentController::class, 'upload_reserva_doctores'])->name('upload_reserva_doctores');

});
Route::middleware('auth')->prefix('configuration')->group(function () {
    Route::get('/inicio', [AppointmentController::class, 'index'])->name('configuration');
    Route::post('/Guardar', [AppointmentController::class, 'store'])->name('configuration.store');
    Route::delete('/eliminar/{id}', [AppointmentController::class, 'destroy'])->name('configuration.destroy');
});
Route::middleware('auth')->prefix('payment')->group(function () {
    Route::get('/inicio', [PaymentsController::class, 'index'])->name('payment');
    Route::post('/Guardar', [PaymentsController::class, 'store'])->name('payment.store');
    Route::patch('/actualizar/{payment}', [PaymentsController::class, 'update'])->name('payment.update');
    Route::get('/mostrar/{payment}', [PaymentsController::class, 'show'])->name('payment.show');
    Route::delete('/eliminar/{payment}', [PaymentsController::class, 'destroy'])->name('payment.destroy');
});



Route::post('/units/{unit}/leader', [UnitLeaderController::class, 'update'])
    ->name('units.leader.update')
    ->middleware('auth');
require __DIR__.'/auth.php';
