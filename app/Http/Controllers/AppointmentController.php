<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, User, Persons, OrganizationalUnit,Event};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
public function index1()
{
    // Obtener doctores activos
    $doctors = Employee::with(['person', 'speciality'])
        ->where('employee_type', 'doctor')
        ->where('status', 'active')
        ->get()
        ->map(function($doctor) {
            return [
                'id' => $doctor->id,
                'name' => $doctor->full_name, // Usando el accesor getFullNameAttribute
                'speciality' => $doctor->speciality->name ?? 'Sin especialidad'
            ];
        });

    // Obtener todos los eventos con relaciones
    $events = Event::with(['doctor.person', 'doctor.speciality', 'user'])
        ->get()
        ->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->user->name, // Nombre del paciente
                'start' => $event->start,
                'end' => $event->end,
                'color' => $event->color,
                'doctor' => $event->doctor ? [
                    'id' => $event->doctor->id,
                    'name' => $event->doctor->full_name, // Usando el accesor
                    'speciality' => $event->doctor->speciality->name ?? 'Sin especialidad'
                ] : null,
                'status' => $event->status,
                'notes' => $event->note ?? 'Sin notas'
            ];
        });
    
    return view('service.appointments.index', compact('doctors', 'events'));
}
public function index()
{
    // Obtener doctores activos
    $doctors = Employee::with(['person', 'speciality'])
        ->where('employee_type', 'doctor')
        ->where('status', 'active')
        ->get()
        ->map(function($doctor) {
            return [
                'id' => $doctor->id,
                'name' => $doctor->full_name, // Usando el accesor getFullNameAttribute
                'speciality' => $doctor->speciality->name ?? 'Sin especialidad'
            ];
        });

    // Obtener todos los eventos con relaciones
    $events = Event::with(['doctor.person', 'doctor.speciality', 'user'])
        ->get()
        ->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->user->name, // Nombre del paciente
                'start' => $event->start,
                'end' => $event->end,
                'color' => $event->color,
                'doctor' => $event->doctor ? [
                    'id' => $event->doctor->id,
                    'name' => $event->doctor->full_name, // Usando el accesor
                    'speciality' => $event->doctor->speciality->name ?? 'Sin especialidad'
                ] : null,
                'status' => $event->status,
                'notes' => $event->note ?? 'Sin notas'
            ];
        });
    
    return view('service.appointments.index', compact('doctors', 'events'));
}



public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'color' => 'nullable|string|max:50',
            'status' => 'nullable|in:pendiente,confirmada,cancelada,completada',
            'note' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                   ->withErrors($validator)
                   ->withInput();
        }

        // Combinar fecha y hora
        $startDateTime = Carbon::parse($request->start_date)
            ->setTimeFromTimeString($request->time);
        $endDateTime = $startDateTime->copy()->addHour();

        return DB::transaction(function () use ($request, $startDateTime, $endDateTime) {
            $doctor = Employee::with(['speciality', 'person'])
                            ->findOrFail($request->doctor_id);

            $event = new Event();
            $event->title = "Cita - Dr. ".$doctor->person->surname_1. " - " . $request->time;
            $event->start = $startDateTime;
            $event->end = $endDateTime; // Cambiado a endDateTime (originalmente estaba startDateTime)
            $event->time = $request->time;
            $event->color = $request->color ?? '#3B82F6';
            $event->note = $request->note;
            $event->user_id = Auth::id();
            $event->doctor_id = $request->doctor_id;
            $event->organizational_unit_id = 1;
            $event->status = $request->status ?? 'pendiente'; // Asignación correcta del estado
            $event->save();

            return redirect()->route('appointments')
                   ->with('success', 'Cita creada exitosamente.');
        });

    } catch (\Exception $e) {
        return redirect()->back()
               ->withInput()
               ->with('error', 'Error al crear la cita: ' . $e->getMessage());
    }
}
public function upload_reserva_doctores($id)
{
    try {
        // Verificar si el doctor existe
        $doctor = Employee::find($id);
        if (!$doctor || $doctor->employee_type !== 'Doctor' || $doctor->status !== 'active') {
            return response()->json(['mensaje' => 'Doctor no encontrado o no activo'], 404);
        }

        // Obtener eventos del doctor activo
        $events = Event::with(['doctor' => function($query) {
            $query->with('person', 'speciality'); // Carga relaciones adicionales
        }])
        ->where('doctor_id', $id)
        ->where('status', 'pendiente')
        ->get();

        // Verificar si se encontraron eventos
        if ($events->isEmpty()) {
            return response()->json(['mensaje' => 'No se encontraron eventos para este doctor'], 404);
        }

        return response()->json($events);
    } catch (\Throwable $th) {
        // Log the error for debugging
        \Log::error('Error en upload_reserva_doctores: ' . $th->getMessage());
        return response()->json(['mensaje'=> 'Error al obtener los eventos', 'error' => $th->getMessage()], 500);
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
    public function cancel($id)
{
    $event = Event::findOrFail($id);
    $event->update(['status' => 'cancelada']);
    $event->delete();
    
    return back()->with('success', 'Cita cancelada y archivada');
}

public function archived()
{
    $events = Event::onlyTrashed()->with(['doctor.speciality'])->get();
    return view('appointments.archived', compact('events'));
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $event = Event::findOrFail($id);
    $event->update(['status' => 'cancelada']); // Cambia estado primero
    $event->delete(); // Esto hará soft delete
    
    return redirect()->back()
           ->with('success', 'Cita marcada como cancelada y archivada');
}
}
