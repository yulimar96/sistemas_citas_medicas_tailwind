<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\ScheduleDetail;


class ScheduleController extends Controller
{

    public function index()
    {    
    // $schedules = DoctorSchedule::with('scheduleDetails','unit', 'doctor')->where('status', 'active')->get();
    $schedules = Schedule::all();
    // $doctors = Doctor::with('person', 'specialitys')->where('employee_type','=', 'doctor')->get(); 
    // $ui = OrganizationalUnit::all(); 
    // return view('service.schedule.index', compact('schedules','doctors','ui'));
    return view('service.schedule.index', compact('schedules'));
    }

   
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        // Validar los datos del formulario
        $request->validate([
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i|after:start_time',
            // 'shift' => 'nullable|string',
        ]);

       
       Schedule::create([
            'day' => $request->day,
            'start_time' => $request->start_time,
            'closing_time' => $request->closing_time,
            // 'shift' => $request->shift,
            'status' => 'active', 
        ]);

        // Redirigir o devolver una respuesta
        // return redirect()->back()->with('success', 'Horario asignado correctamente.');
        return redirect()->route('schedule')->with('success', 'Horario asignado correctamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al crear a la Secretaria: ' . $e->getMessage());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
