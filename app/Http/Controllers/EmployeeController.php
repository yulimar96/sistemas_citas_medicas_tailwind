<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{
    User,
    Persons,
    FederalStates,
    Employee,
    EmployeeContractTypes,
    OrganizationalUnitTypes,
    MedicalSpeciality,
    EmployeePosition,
    ScheduleDetail
};

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with([
                'person', 
                'position', 
                'contractType', 
                'organizationalUnitType'
            ])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $stats = [
            'total' => $employees->count(),
            'active' => $employees->where('status', 'active')->count(),
            'doctors' => $employees->where('employee_type', 'Doctor')->count(),
            'admins' => $employees->where('employee_type', 'admin')->count(),
        ];

        return view('management.employee.index', array_merge([
            'employees' => $employees,
            'stats' => $stats,
            'employee_contract' => EmployeeContractTypes::all(),
              'organizational_unit' => OrganizationalUnitTypes::all(),
        'position' => EmployeePosition::all(),
        'schedules' => scheduleDetail::all(),
        ], $this->getFormData()));
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
            'medical_license' => 'nullable|string|max:20|unique:employees',
            'specialitys_id' => 'nullable|exists:medical_specialities,id', // Cambiado a singular
             'schedule_id' => 'nullable',
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
            $employee = new Employee();
            $employee->status = 'active';
            $employee->person_id = $person->id; 
            $employee->employee_type = 'Doctor'; // Cambiado de 'Secretaria' a 'Doctor'
            $employee->hire_date = $validatedData['hire_date']; 
            $employee->employee_contract_types_id = $validatedData['employee_contract_types_id']; 
            $employee->employee_position_id = $validatedData['employee_position_id']; 
            $employee->organizational_unit_types_id = $validatedData['organizational_unit_types_id']; 
            $employee->medical_license = $validatedData['medical_license'];
            $employee->specialitys_id = $validatedData['specialitys_id'];
            $employee->schedule_id = $validatedData['schedule_id'];
            $employee->save();

            return redirect()->route('doctor')
                   ->with('success', 'Doctor creado exitosamente.');
        });

    } catch (\Exception $e) {
        return redirect()->back()
               ->withInput()
               ->with('error', 'Error al crear el doctor: ' . $e->getMessage());
    }
}
    protected function createUser(array $data)
    {
        return User::create([
            'name' => trim("{$data['name_1']} {$data['name_2']}"),
            'email' => $data['email'],
            'password' => bcrypt($data['identification_number']), // Usar CI como contraseña inicial
        ]);
    }

    protected function createPerson(array $data, User $user)
    {
        return Persons::create([
            'name_1' => $data['name_1'],
            'name_2' => $data['name_2'],
            'surname_1' => $data['surname_1'],
            'surname_2' => $data['surname_2'],
            'sex' => $data['sex'],
            'birth_date' => $data['birthdate'],
            'blood_type' => $data['blood_type'],
            'nacionality' => $data['nacionality'],
            'identification_number' => $data['identification_number'],
            'phone_area_codes' => $data['code_area'],
            'phone_number' => $data['phone'],
            'cell_phone_area_codes' => $data['cell_phone_area_codes'],
            'cellphone_number' => $data['cellphone_number'],
            'federals_state_id' => $data['federals_state_id'],
            'municipalities_id' => $data['municipalities_id'],
            'parish_id' => $data['parish_id'],
            'room_type' => $data['room_type'],
            'level_of_education' => $data['level_of_education'],
            'user_id' => $user->id,
            'status' => 'active',
        ]);
    }

    protected function createEmployee(array $data, Persons $person)
    {
        return Employee::create([
            'person_id' => $person->id,
            'employee_type' => $data['employee_type'],
            'hire_date' => $data['hire_date'],
            'employee_contract_types_id' => $data['employee_contract_types_id'],
            'schedule_id' => $data['schedule_id'],
            'employee_position_id' => $data['employee_position_id'],
            'organizational_unit_types_id' => $data['organizational_unit_types_id'],
            'medical_license' => $data['medical_license'] ?? null,
            'specialitys_id' => $data['specialitys_id'],
            'status' => $data['status'],
        ]);
    }

    protected function getFormData()
    {
        return [
            'employee_contracts' => EmployeeContractTypes::all(),
            'organizational_units' => OrganizationalUnitTypes::all(),
            'positions' => EmployeePosition::all(),
            'states' => FederalStates::with(['municipalities.parishes'])->get(),
            'specialities' => MedicalSpeciality::all(),
            'schedules' => ScheduleDetail::all()
        ];
    }


    // Mostrar detalles de empleado
    public function show($id)
    {
        $employee = Employee::with([
            'person.user', 
            'position', 
            'contractType', 
            'organizationalUnitType',
            'speciality'
        ])->findOrFail($id);

        return view('management.employees.show', [
            'employee' => $employee,
            'typeLabel' => self::EMPLOYEE_TYPES[$employee->employee_type]['label']
        ]);
    }

    // Actualizar empleado
    public function update(Request $request, $id)
    {
         try {
        // Validación de los campos
        $request->validate([
            'name_1' => 'required|string|max:255',
            'name_2' => 'nullable|string|max:255',
            'surname_1' => 'required|string|max:255',
            'surname_2' => 'nullable|string|max:255',
            'sex' => 'required|boolean',
            'birthdate' => 'required|date',
            'blood_type' => 'required|string|max:20',
            'nacionality' => 'required|string|max:50',
            'identification_number' => 'required|string|max:20|unique:peoples,identification_number',
            'email' => 'required|email|unique:users,email',
            'code_area' => 'required|string|max:7',
            'phone' => 'required|string|max:15',
            'cell_phone_area_codes' => 'required|string|max:7',
            'cellphone_number' => 'required|string|max:7',
            'federals_state_id' => 'required|exists:federal_states,id',
            'municipalities_id' => 'required|exists:municipalities,id',
            'parish_id' => 'required|exists:parishes,id',
            'room_type' => 'required|string|max:100',
            'level_of_education' => 'required|string|max:100',
            'employee_contract_types_id' => 'nullable|exists:employee_contract_types,id',
            'employee_position_id' => 'nullable|exists:employee_positions,id',
            'organizational_unit_types_id' => 'nullable|exists:organizational_unit_types,id',
            'medical_license' => 'required|string|max:20|unique:employees',
            'specialitys_id' => 'required|string|max:50',
            'hire_date' => 'required|date',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar la contraseña
        ]);

        // Crear la persona
        $person = new Persons();
        $person->name_1 = $request->name_1;
        $person->name_2 = $request->name_2;
        $person->surname_1 = $request->surname_1;
        $person->surname_2 = $request->surname_2;
        $person->sex = $request->sex;
        $person->birth_date = $request->birthdate;
        $person->blood_type = $request->blood_type;
        $person->nacionality = $request->nacionality;
        $person->identification_number = $request->identification_number;
        $person->phone_area_codes = $request->code_area;
        $person->phone_number = $request->phone;
        $person->cell_phone_area_codes = $request->cell_phone_area_codes;
        $person->cellphone_number = $request->cellphone_number;
        $person->federals_state_id = $request->federals_state_id;
        $person->municipalities_id = $request->municipalities_id;
        $person->parish_id = $request->parish_id;
        $person->room_type = $request->room_type;
        $person->level_of_education = $request->level_of_education;
        $person->user_id = $user->id; 
        $person->status = 'active';
        $person->save();

        // Crear la secretaria
        $doctor = new Doctor();
        $doctor->person_id = $person->id; // Relacionar con la persona
        $doctor->employee_type = 'Doctor';
        $doctor->hire_date = $request->hire_date; 
        $doctor->employee_contract_types_id = $request->employee_contract_types_id; // Si se proporciona
        $doctor->employee_position_id = $request->position_id; // Si se proporciona
        $doctor->organizational_unit_types_id = $request->organizational_unit_types_id; // Si se proporciona
        $doctor->medical_license = $request->medical_license; // Si se proporciona
        $doctor->specialitys_id = $request->specialitys_id; // Si se proporciona
        $doctor->status = 'active';
        $doctor->save();

        return redirect()->route('doctor')->with('success', 'Doctor creada exitosamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al crear a la Doctor: ' . $e->getMessage());
    }
    }

    // Desactivar empleado
    public function destroy($id)
    {
        
    }

}