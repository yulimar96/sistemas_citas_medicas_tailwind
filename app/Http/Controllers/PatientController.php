<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persons;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\FederalStates;
use App\Models\EmployeeContractTypes;
use App\Models\OrganizationalUnitTypes;
use App\Models\MedicalSpeciality;
use App\Models\Position;
use App\Models\Allergy;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatientController extends Controller
{
    public function index()
    {
        // Consultas optimizadas con eager loading y selects específicos
 $patients = Patient::with(['person' => function($query) {
    $query->select('id', 'name_1', 'name_2', 'surname_1', 'surname_2', 
                  'identification_number', 'nacionality', 'birth_date',
                  'sex', 'cell_phone_area_codes', 'cellphone_number');
}])
->where('status', 'active')
->whereNotNull('person_id') // Asegura que tenga relación
->select('id', 'person_id', 'medical_history', 'registration_date', 'last_visit')
->orderBy('last_visit', 'desc')
->paginate(15);

        // Estadísticas optimizadas
        $stats = DB::table('patients')
            ->select(
                DB::raw('COUNT(*) as patient_count'),
                DB::raw('SUM(CASE WHEN status = "active" THEN 1 ELSE 0 END) as active_patients'),
                DB::raw('SUM(CASE WHEN DATE(last_visit) = CURDATE() THEN 1 ELSE 0 END) as today_visits')
            )
            ->first();

        // Datos para formularios (solo lo necesario)
        $formData = [
            'allergies' => Allergy::select('id', 'allergy_type')->get(),
            'states' => FederalStates::with([
                'cities' => function($query) {
                    $query->select('id', 'federal_states_id', 'name');
                },
                'municipalities' => function($query) {
                    $query->select('id', 'federal_states_id', 'name')
                          ->with(['parishes' => function($query) {
                              $query->select('id', 'municipality_id', 'name');
                          }]);
                }
            ])->select('id', 'name')->get()
        ];

        return view('management.patient.index', array_merge([
            'patients' => $patients,
            'patientCount' => $stats->patient_count,
            'activePatients' => $stats->active_patients,
            'todayVisits' => $stats->today_visits
        ], $formData));
    }

    public function store(Request $request)
    {
        // Validación mejorada con mensajes personalizados
        $validated = $request->validate([
            'name_1' => 'required|string|max:255',
            'name_2' => 'nullable|string|max:255',
            'surname_1' => 'required|string|max:255',
            'surname_2' => 'nullable|string|max:255',
            'sex' => 'required|boolean',
            'birthdate' => 'required|date|before_or_equal:today',
            'nacionality' => 'required|string|max:50',
            'identification_number' => 'required|string|max:20|unique:peoples,identification_number',
            'email' => 'required|email|unique:users,email',
            'cell_phone_area_codes' => 'required|string|max:7',
            'cellphone_number' => 'required|string|max:15',
            'federals_state_id' => 'required|exists:federal_states,id',
            'municipalities_id' => 'required|exists:municipalities,id',
            'parish_id' => 'required|exists:parishes,id',
            'medical_history' => 'required|string|max:20|unique:patients',
            'has_allergies' => 'boolean',
            'allergy_type' => 'nullable|required_if:has_allergies,true|exists:allergies,id',
            'observation' => 'nullable|string|max:255',
        ], [
            'birthdate.before_or_equal' => 'La fecha de nacimiento no puede ser futura',
            'allergy_type.required_if' => 'Debe seleccionar un tipo de alergia si el paciente tiene alergias',
        ]);

        DB::beginTransaction();

        try {
            // Crear usuario
            $user = DB::table('users')->insertGetId([
                'name' => $request->name_1 . ' ' . $request->surname_1,
                'email' => $request->email,
                'password' => bcrypt($request->identification_number), // CI como contraseña inicial
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Crear persona
            $personId = DB::table('peoples')->insertGetId([
                'name_1' => $request->name_1,
                'name_2' => $request->name_2,
                'surname_1' => $request->surname_1,
                'surname_2' => $request->surname_2,
                'sex' => $request->sex,
                'birth_date' => $request->birthdate,
                'nacionality' => $request->nacionality,
                'identification_number' => $request->identification_number,
                'cell_phone_area_codes' => $request->cell_phone_area_codes,
                'cellphone_number' => $request->cellphone_number,
                'federals_state_id' => $request->federals_state_id,
                'municipalities_id' => $request->municipalities_id,
                'parish_id' => $request->parish_id,
                'user_id' => $user,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Crear paciente
            DB::table('patients')->insert([
                'person_id' => $personId,
                'medical_history' => $request->medical_history,
                'registration_date' => now(),
                'last_visit' => now(),
                'has_allergies' => $request->has_allergies ?? false,
                'allergy_type' => $request->allergy_type,
                'observation' => $request->observation,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::commit();

            return redirect()->route('patient.index')
                ->with('success', 'Paciente registrado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al registrar el paciente: ' . $e->getMessage());
        }
    }

    public function show(Patient $patient)
    {
        // Carga solo los datos necesarios para mostrar
        $patient->load([
            'person' => function($query) {
                $query->select('id', 'name_1', 'name_2', 'surname_1', 'surname_2', 'identification_number', 
                              'nacionality', 'birth_date', 'sex', 'blood_type', 'phone_area_codes', 
                              'phone_number', 'cell_phone_area_codes', 'cellphone_number', 'room_type', 
                              'level_of_education', 'federals_state_id', 'municipalities_id', 'parish_id')
                      ->with(['user' => function($query) {
                          $query->select('id', 'email');
                      }, 'federalState', 'municipality', 'parish']);
            },
            'allergy'
        ]);

        return response()->json($patient);
    }

    public function edit(Patient $patient)
    {
        $patient->load([
            'person' => function($query) {
                $query->select('id', 'name_1', 'name_2', 'surname_1', 'surname_2', 'identification_number', 
                              'nacionality', 'birth_date', 'sex', 'blood_type', 'phone_area_codes', 
                              'phone_number', 'cell_phone_area_codes', 'cellphone_number', 'room_type', 
                              'level_of_education', 'federals_state_id', 'municipalities_id', 'parish_id')
                      ->with(['user' => function($query) {
                          $query->select('id', 'email');
                      }]);
            }
        ]);

        $formData = [
            'allergies' => Allergy::select('id', 'name')->get(),
            'states' => FederalStates::with([
                'municipalities' => function($query) {
                    $query->select('id', 'federal_entities_id', 'name')
                          ->with(['parishes' => function($query) {
                              $query->select('id', 'municipalities_id', 'name');
                          }]);
                }
            ])->select('id', 'name')->get()
        ];

        return response()->json(array_merge(['patient' => $patient], $formData));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name_1' => 'required|string|max:255',
            'name_2' => 'nullable|string|max:255',
            'surname_1' => 'required|string|max:255',
            'surname_2' => 'nullable|string|max:255',
            'birthdate' => 'required|date|before_or_equal:today',
            'cell_phone_area_codes' => 'required|string|max:7',
            'cellphone_number' => 'required|string|max:15',
            'medical_history' => 'required|string|max:20|unique:patients,medical_history,'.$patient->id,
            'has_allergies' => 'boolean',
            'allergy_type' => 'nullable|required_if:has_allergies,true|exists:allergies,id',
            'observation' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            // Actualizar persona
            DB::table('peoples')
                ->where('id', $patient->person_id)
                ->update([
                    'name_1' => $request->name_1,
                    'name_2' => $request->name_2,
                    'surname_1' => $request->surname_1,
                    'surname_2' => $request->surname_2,
                    'birth_date' => $request->birthdate,
                    'cell_phone_area_codes' => $request->cell_phone_area_codes,
                    'cellphone_number' => $request->cellphone_number,
                    'updated_at' => now()
                ]);

            // Actualizar paciente
            $patient->update([
                'medical_history' => $request->medical_history,
                'has_allergies' => $request->has_allergies ?? false,
                'allergy_type' => $request->allergy_type,
                'observation' => $request->observation,
                'updated_at' => now()
            ]);

            DB::commit();

            return response()->json(['success' => 'Paciente actualizado correctamente']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Patient $patient)
    {
        DB::beginTransaction();

        try {
            // Marcar como inactivo en lugar de eliminar
            $patient->update(['status' => 'inactive']);
            
            // También marcar la persona como inactiva
            DB::table('peoples')
                ->where('id', $patient->person_id)
                ->update(['status' => 'inactive']);
            
            DB::commit();

            return redirect()->route('patient.index')
                ->with('success', 'Paciente desactivado correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al desactivar el paciente: ' . $e->getMessage());
        }
    }
}
