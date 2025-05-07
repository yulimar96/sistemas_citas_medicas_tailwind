<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persons;
use App\Models\scheduleDetail;
use App\Models\FederalStates;
use App\Models\Employee;
use App\Models\EmployeeContractTypes;
use App\Models\OrganizationalUnitTypes;
use App\Models\EmployeePosition;
use Illuminate\Support\Facades\{DB, Hash};


class SecretariatController extends Controller
{
public function index()
{
    return view('management.secretariat.index', [
        'employee_contract' => EmployeeContractTypes::all(),
        'organizational_unit' => OrganizationalUnitTypes::all(),
        'position' => EmployeePosition::all(),
        'schedules' => scheduleDetail::all(),
        'states' => FederalStates::with(['cities', 'municipalities.parishes'])->get(),
        'users' => User::where('status', 'active')->count(),
        'secretariats' => Employee::where('employee_type', 'Secretaria')
                                ->where('status', 'active')
                                ->paginate(10),
        'secretariat' => Employee::where('employee_type', 'Secretaria')->count()
    ]);
}

    public function show($id)
    {
        $Secretariat = Employee::with('user')->findOrFail($id);
        return view('management.secretariat.show', compact( 'Secretariat'));
      
        
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
            'hire_date' => 'required|date',
            'password' => 'required|string|min:8', // Asegúrate de validar la contraseña
            'schedule_id' => 'required|exists:schedules,id', // Asegúrate de validar el schedule_id
 // Asegúrate de validar el position_id
        ]);

        return DB::transaction(function () use ($validatedData) {
            // Crear el usuario
            $user = User::create([
                'name' => "{$validatedData['name_1']} {$validatedData['surname_1']}",
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']), // Encriptar la contraseña
                'status' => 'active'
            ]);

            // Crear la persona
            $person = new Persons();
            $person->name_1 = $validatedData['name_1'];
            $person->name_2 = $validatedData['name_2'];
            $person->surname_1 = $validatedData['surname_1'];
            $person->surname_2 = $validatedData['surname_2'];
            $person->sex = $validatedData['sex'];
            $person->birth_date = $validatedData['birthdate'];
            $person->blood_type = $validatedData['blood_type'];
            $person->nacionality = $validatedData['nacionality'];
            $person->identification_number = $validatedData['identification_number'];
            $person->phone_area_codes = $validatedData['code_area'];
            $person->phone_number = $validatedData['phone'];
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

            // Crear la secretaria
            $secretariat = new Employee();
            $secretariat->status = 'active';
            $secretariat->person_id = $person->id; 
            $secretariat->employee_type = 'Secretaria';
            $secretariat->schedule_id  =  $validatedData['schedule_id'];
            $secretariat->hire_date = $validatedData['hire_date']; 
            $secretariat->employee_contract_types_id = $validatedData['employee_contract_types_id']; 
            $secretariat->employee_position_id = $validatedData['employee_position_id']; 
            $secretariat->organizational_unit_types_id = $validatedData['organizational_unit_types_id']; 
            $secretariat->save();

            return redirect()->route('secretariat')->with('success', 'Secretaria creada exitosamente.');
        });
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al crear a la Secretaria: ' . $e->getMessage());
    }
}
public function getUser($id)
{
    $secretariat = Employee::findOrFail($id);
    return response()->json($user);
}
public function edit($id)
{
    $secretariat = Employee::findOrFail($id);
    return view('management.secretariat.edit', compact( 'secretariat'));
}


public function update(Request $request, $id)
{
    try {
        // dd($request->email, $id); Verifica el correo y el ID
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Excluir el usuario actual de la validación de unicidad
            'password' => 'nullable|string|min:8', // Hacer que la contraseña sea opcional
        ]);
        
        // Encontrar el usuario por ID
        $secretariat = Employee::findOrFail($id); // Usar findOrFail para lanzar una excepción si no se encuentra

        // Actualizar los datos del usuario
        $secretariat->name = $request->name;
        $secretariat->email = $request->email;
        $secretariat->status = $request->active;

        // Solo actualizar la contraseña si se proporciona
        if ($request->filled('password')) {
            $secretariat->password = bcrypt($request->password); // Encriptar la contraseña
        }

        $secretariat->update(); // Guardar los cambios

        return redirect()->route('secretariat')->with('success', 'Usuario actualizado exitosamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
    }
}

public function destroy($id)
{
    $secretariat = Employee::findOrFail($id);
    
    // Cambiar el estado del usuario a 'inactive'
    $secretariat->status = 'inactive'; // O 'desactive', según tu preferencia
    $secretariat->save(); // Guardar los cambios

    return redirect()->route('secretariat')->with('success', 'Usuario deshabilitado exitosamente.');
}

}
