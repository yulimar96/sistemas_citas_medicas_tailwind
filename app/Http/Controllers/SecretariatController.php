<?php

namespace App\Http\Controllers;

use App\Models\Secretariets;
use App\Models\User;
use Illuminate\Http\Request;

class SecretariatController extends Controller
{
    public function index()
    {
        // $secretariats = Secretariat::where('status', '=', 'active')->orderBy("id","desc")->paginate(5);
        // return view("management.secretariat.index", compact("secretariats"));
        $users = User::count();
        $secretariats = Secretariets::with('user')->get();
        return view('management.secretariat.index', compact('users', 'secretariats'));
    }

    public function create()
    {
        //
    }
    public function show($id)
    {
        $secretariat = Secretariat::findOrFail($id);
        return response()->json($usuario); // Devuelve los datos del usuario en formato JSON
    }
    public function store(Request $request)
    {   
        // dd($request->all());
        // return response()->json($request);
    try {
    $request->validate([
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email', // Cambia 'your_table' por el nombre de tu tabla
        'birthdate' => 'required|date',
        'nacionality' => 'required|string',
        'identification_number' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'code_area' => 'required|string',
        'phone' => 'required|string|max:15',
        'password' => 'required|string|min:8|confirmed', // 'confirmed' verifica que el campo 'confirm_password' coincida
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar la contraseña
        ]);

        $secretariat = new secretariat();
        $secretariat->user_id = $user->id;
        $secretariat->name = $request->name;
        $secretariat->last_name = $request->last_name;
        $secretariat->nacionality = $request->nacionality;
        $secretariat->identification_number = $request->identification_number;
        $secretariat->birthdate = $request->birthdate;
        $secretariat->code_area = $request->code_area;
        $secretariat->phone = $request->phone;
        $secretariat->address = $request->address;
        $secretariat->save();

        return redirect()->route('secretariat.index')->with('success', 'Secretaria creada exitosamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al crear a la Secretaria: ' . $e->getMessage());
    }
}
public function getUser($id)
{
    $secretariat = Secretariets::findOrFail($id);
    return response()->json($user);
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
        $secretariat = Secretariets::findOrFail($id); // Usar findOrFail para lanzar una excepción si no se encuentra

        // Actualizar los datos del usuario
        $secretariat->name = $request->name;
        $secretariat->email = $request->email;
        $secretariat->status = $request->active;

        // Solo actualizar la contraseña si se proporciona
        if ($request->filled('password')) {
            $secretariat->password = bcrypt($request->password); // Encriptar la contraseña
        }

        $secretariat->update(); // Guardar los cambios

        return redirect()->route('secretariat.index')->with('success', 'Usuario actualizado exitosamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
    }
}

public function destroy($id)
{
    $secretariat = Secretariat::findOrFail($id);
    
    // Cambiar el estado del usuario a 'inactive'
    $secretariat->status = 'inactive'; // O 'desactive', según tu preferencia
    $secretariat->save(); // Guardar los cambios

    return redirect()->route('secretariat.index')->with('success', 'Usuario deshabilitado exitosamente.');
}

}
