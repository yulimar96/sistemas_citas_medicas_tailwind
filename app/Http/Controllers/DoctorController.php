<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\{Employee, MedicalSpeciality, EmployeeContractTypes, 
                OrganizationalUnitTypes, EmployeePosition, FederalStates};
use Illuminate\Support\Facades\{DB, Hash};
use App\Models\{User, Persons};


class DoctorController extends Controller
{
    public function index()
    {
        // Consultas optimizadas con eager loading selectivo
        return view('management.doctor.index', [
            'specialities' => MedicalSpeciality::active()->get(['id', 'name']),
            'contractTypes' => EmployeeContractTypes::active()->get(['id', 'name']),
            'unitTypes' => OrganizationalUnitTypes::active()->get(['id', 'name']),
            'positions' => EmployeePosition::active()->get(['id', 'name']),
            'states' => FederalStates::with(['municipalities.parishes'])->get(['id', 'name']),
            'doctors' => Employee::doctors()
                            ->with(['person:id,name_1,surname_1,identification_number,nacionality', 
                                   'speciality:id,name'])
                            ->paginate(10),
            'activeDoctorsCount' => Employee::doctors()->active()->count()
        ]);
    }

public function store(Request $request)
{
    try {
        // Validación de los campos
        $validatedData = $request->validate([
            'name_1' => 'required|string|max:255',
            'name_2' => 'nullable|string|max:255',
            'surname_1' => 'required|string|max:255',
            'surname_2' => 'nullable|string|max:255',
            'sex' => 'required|boolean',
            'birth_date' => 'required|date',
            'blood_type' => 'required|string|max:20',
            'nacionality' => 'required|string|max:50',
            'identification_number' => 'required|string|max:20|unique:peoples,identification_number',
            'email' => 'required|email|unique:users,email',
            'phone_area_codes' => 'required|string|max:7',
            'phone_number' => 'required|string|max:15',
            'cell_phone_area_codes' => 'required|string|max:7',
            'cellphone_number' => 'required|string|max:15',
            'federals_state_id' => 'required|exists:federal_states,id', // Cambiado a singular
            'municipalities_id' => 'required|exists:municipalities,id', // Cambiado a singular
            'parish_id' => 'required|exists:parishes,id',
            'room_type' => 'required|string|max:100',
            'level_of_education' => 'required|string|max:100',
            'employee_contract_types_id' => 'nullable|exists:employee_contract_types,id', // Cambiado a singular
            'employee_position_id' => 'nullable|exists:employee_positions,id',
            'organizational_unit_types_id' => 'nullable|exists:organizational_unit_types,id', // Cambiado a singular
            'medical_license' => 'required|string|max:20|unique:employees',
            'specialitys_id' => 'required|exists:medical_specialities,id', // Cambiado a singular
            'hire_date' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
        ]);

        return DB::transaction(function () use ($validatedData) {
            // Creación optimizada del usuario
            $user = User::create([
                'name' => "{$validatedData['name_1']} {$validatedData['surname_1']}",
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'status' => 'active'
            ]);

            // Creación de persona con datos validados
            $person = new Persons();
            $person->name_1 = $validatedData['name_1'];
            $person->name_2 = $validatedData['name_2'] ?? null;
            $person->surname_1 = $validatedData['surname_1'];
            $person->surname_2 = $validatedData['surname_2'] ?? null;
            $person->sex = $validatedData['sex'];
            $person->birth_date = $validatedData['birth_date'];
            $person->blood_type = $validatedData['blood_type'];
            $person->nacionality = $validatedData['nacionality'];
            $person->identification_number = $validatedData['identification_number'];
            $person->phone_area_codes = $validatedData['phone_area_codes'];
            $person->phone_number = $validatedData['phone_number'];
            $person->cell_phone_area_codes = $validatedData['cell_phone_area_codes'];
            $person->cellphone_number = $validatedData['cellphone_number'];
            $person->federals_state_id = $validatedData['federals_state_id'];
            $person->municipalities_id = $validatedData['municipalities_id'];
            $person->parish_id = $validatedData['parish_id'];
            $person->room_type = $validatedData['room_type'];
            $person->level_of_education = $validatedData['level_of_education'];
            $person->user_id = $user->id;
            $person->status = 'active';
            $person->save();

            // Creación del doctor
            $doctor = new Employee();
            $doctor->status = 'active';
            $doctor->person_id = $person->id; 
            $doctor->employee_type = 'Doctor'; // Cambiado de 'Secretaria' a 'Doctor'
            $doctor->hire_date = $validatedData['hire_date']; 
            $doctor->employee_contract_types_id = $validatedData['employee_contract_types_id']; 
            $doctor->employee_position_id = $validatedData['employee_position_id']; 
            $doctor->organizational_unit_types_id = $validatedData['organizational_unit_types_id']; 
            $doctor->medical_license = $validatedData['medical_license'];
            $doctor->specialitys_id = $validatedData['specialitys_id'];
            $doctor->save();

            return redirect()->route('doctor')
                   ->with('success', 'Doctor creado exitosamente.');
        });

    } catch (\Exception $e) {
        return redirect()->back()
               ->withInput()
               ->with('error', 'Error al crear el doctor: ' . $e->getMessage());
    }
}
    /**
     * Update the specified doctor.
     */
    public function update(Request $request, Employee $doctor)
    {
        DB::transaction(function () use ($request, $doctor) {
            // Actualizar persona
            $doctor->person->update([
                'name_1' => $request->name_1,
                // ... otros campos
            ]);

            // Actualizar doctor
            $doctor->update([
                'employee_contract_types_id' => $request->employee_contract_types_id,
                // ... otros campos
            ]);
        });

        return redirect()->route('doctors.show', $doctor)
            ->with('success', 'Doctor actualizado exitosamente.');
    }

    /**
     * Deactivate the specified doctor.
     */
    public function destroy(Employee $doctor)
    {
        $doctor->update(['status' => 'inactive']);
        
        return redirect()->route('doctors.index')
            ->with('success', 'Doctor deshabilitado exitosamente.');
    }
}