<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoctorSchedule;
use App\Models\Employee;
use App\Models\OrganizationalUnit;
use App\Models\MedicalAppointments;

class DoctorSchedulesController extends Controller
{
    
public function index()
{
    $schedules = DoctorSchedule::with('employee.person', 'employee.speciality', 'organizationalUnit')
        ->where('status', 'active')
        ->orderBy('day')
        ->orderBy('start_time')
        ->paginate(10);

    // Asegúrate de cargar organizationalUnit para los doctores también
    $doctors = Employee::with('person', 'speciality', 'units')
        ->where('employee_type', 'Doctor')
        ->get(); 

    $organizational_unit = OrganizationalUnit::all(); 

    return view('service.doctor_schedule.index', compact('schedules', 'doctors', 'organizational_unit'));
}

public function create()
{
    $organizational_units = OrganizationalUnit::all();
    return view('service.doctor_schedule.create', compact('organizational_units'));
}
public function upload($id)
{
    try {
        
$schedules = DoctorSchedule::with([
        'employee' => function($query) {
            $query->where('employee_type', 'Doctor') // Filtra solo doctores
                  ->with('person', 'speciality'); // Carga relaciones adicionales
        },
        'organizationalUnit' // Carga la unidad organizacional
    ])
    ->where('organization_unit_id', $id) // Filtra por unidad seleccionada
    ->where('status', 'active') // Solo horarios activos
    ->orderBy('day')
    ->orderBy('start_time')
    ->get();
        //  return response()->json($schedules);
    return view('service.doctor_schedule.cargar_datos_consultorios', compact('schedules'));

    } catch (\Throwable $th) {
       return response()->json(['mensaje'=> 'Error']);
    }
}

public function store(Request $request)
{
    try {
        // Validación básica de campos
        $validated = $request->validate([
            'day' => 'required|string|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'start_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i|after:start_time',
            'shift' => 'required|string|in:morning,afternoon,evening,night',
            'doctor_id' => 'required|exists:employees,id', 
            'organization_unit_id' => 'required|exists:organizational_units,id', 
        ]);

        // Convertir a objetos Carbon para comparación
        $newStart = \Carbon\Carbon::parse($validated['start_time']);
        $newEnd = \Carbon\Carbon::parse($validated['closing_time']);

        // Validación 1: Mismo doctor en mismo día (solo horarios activos)
        $conflictingDoctorSchedule = DoctorSchedule::where('doctor_id', $validated['doctor_id'])
            ->where('day', $validated['day'])
            ->where('status', 'active') // Solo verificar horarios activos
            ->where(function($query) use ($newStart, $newEnd) {
                $query->where(function($q) use ($newStart, $newEnd) {
                    $q->where('start_time', '<', $newEnd->format('H:i:s'))
                      ->where('closing_time', '>', $newStart->format('H:i:s'));
                });
            })
            ->exists();

        if ($conflictingDoctorSchedule) {
            return back()->with('error', 'El doctor ya tiene un horario activo en este intervalo.');
        }

        // Validación 2: Mismo consultorio en mismo día (solo horarios activos)
        $conflictingRoomSchedule = DoctorSchedule::where('organization_unit_id', $validated['organization_unit_id'])
            ->where('day', $validated['day'])
            ->where('status', 'active') // Solo verificar horarios activos
            ->where(function($query) use ($newStart, $newEnd) {
                $query->where(function($q) use ($newStart, $newEnd) {
                    $q->where('start_time', '<', $newEnd->format('H:i:s'))
                      ->where('closing_time', '>', $newStart->format('H:i:s'));
                });
            })
            ->exists();

        if ($conflictingRoomSchedule) {
            return back()->with('error', 'El consultorio ya tiene un horario activo en este intervalo.');
        }

        // Crear el nuevo horario
        DoctorSchedule::create([
            'doctor_id' => $validated['doctor_id'],
            'day' => $validated['day'],
            'start_time' => $newStart->format('H:i:s'),
            'closing_time' => $newEnd->format('H:i:s'),
            'shift' => $validated['shift'],
            'organization_unit_id' => $validated['organization_unit_id'],
            'status' => 'active',
        ]);

        return redirect()->route('doctor_schedule')->with('success', 'Horario creado correctamente.');

    } catch (\Exception $e) {
        return back()->with('error', 'Error al crear horario: ' . $e->getMessage());
    }
}

  public function getSchedule($id)
{
    $schedule = DoctorSchedule::findOrFail($id);
    return response()->json($schedule);
}

    public function edit(string $id)
    {
        //
    }

 public function update(Request $request, string $id)
{
    try {
        // Validación de los campos
        $request->validate([
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i|after:start_time',
            'shift' => 'nullable|string',
            'doctor_id' => 'required', 
            'organization_unit_id' => 'required', 
        ]);

        // Obtener los tiempos de inicio y cierre
        $startTime = \Carbon\Carbon::createFromFormat('H:i', $request->input('start_time'));
        $closingTime = \Carbon\Carbon::createFromFormat('H:i', $request->input('closing_time'));

        // Obtener el horario actual
        $schedule = DoctorSchedule::findOrFail($id);

        // Validación de superposición de horarios para cualquier doctor en el mismo consultorio
        $existingSchedules = DoctorSchedule::where('organization_unit_id', $request->organization_unit_id)
            ->where('day', $request->day)
            ->where('doctor_id', '!=', $request->doctor_id) // Asegúrate de que no sea el mismo doctor
            ->where(function ($query) use ($startTime, $closingTime) {
                $query->where('start_time', '<', $closingTime)
                      ->where('closing_time', '>', $startTime);
            })
            ->exists();

        if ($existingSchedules) {
            return back()->with('error', 'Ya existe un horario programado en este consultorio para el mismo día y hora con otro doctor.');
        }

        // Asignar los valores a las propiedades del objeto
        $schedule->doctor_id = $request->doctor_id;
        $schedule->day = $request->day;
        $schedule->start_time = $startTime->format('H:i'); // Asegúrate de guardar en el formato correcto
        $schedule->closing_time = $closingTime->format('H:i'); // Asegúrate de guardar en el formato correcto
        $schedule->shift = $request->shift;
        $schedule->organization_unit_id = $request->organization_unit_id;
        $schedule->status = 'active'; 

        // Guardar los cambios
        $schedule->save();

        return redirect()->route('doctor_schedule')->with('success', 'Horario asignado correctamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al crear el horario: ' . $e->getMessage());
    }
}


  public function destroy($id)
{
    try {
        // Buscar el horario
        $schedule = DoctorSchedule::findOrFail($id);
        
        // Verificar si ya está deshabilitado
        if ($schedule->status === 'inactive') {
            return redirect()->back()
                   ->with('warning', 'Este horario ya se encuentra deshabilitado.');
        }
        
        // // Opcional: Verificar si tiene citas futuras
        // $hasFutureAppointments = MedicalAppointments::where('doctor_schedule_id', $id)
        //                          ->whereDate('date', '>=', now()->toDateString())
        //                          ->exists();
        
        // if ($hasFutureAppointments) {
        //     return redirect()->back()
        //            ->with('error', 'No se puede deshabilitar: tiene citas futuras programadas.');
        // }
        
        // Deshabilitar el horario
        $schedule->update(['status' => 'inactive']);
        
        return redirect()->route('doctor_schedule')
               ->with('success', 'Horario deshabilitado correctamente.');
               
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->back()
               ->with('error', 'El horario no fue encontrado.');
               
    } catch (\Exception $e) {
        return redirect()->back()
               ->with('error', 'Error al deshabilitar el horario: ' . $e->getMessage());
    }
}
}
