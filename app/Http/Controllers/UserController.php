<?php

namespace App\Http\Controllers;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class UserController extends Controller
{
    use AuthorizesRequests; 
 public function index()
{
    $this->authorize('viewAny', User::class);
    // Obtener usuarios paginados (con sus roles)
    $users = User::with('roles')->orderBy('id')->paginate(10); // 10 usuarios por página

    // Conteos usando Spatie Permission
    $adminCount = User::role('admin')->count();
    $secretaryCount = User::role('secretaria')->count();
    $doctorCount = User::role('doctor')->count();
    $patientCount = User::role('paciente')->count();
    $activeUsers = User::where('status', 'active')->count();

    return view('management.user.index', compact(
        'users',          // <- Asegúrate de incluir esta variable
        'adminCount',
        'secretaryCount',
        'doctorCount',
        'patientCount',
        'activeUsers'
    ));
}

    public function create()
    {
        //
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view("management.user.show", compact("user")); // Devuelve los datos del usuario en formato JSON
    }
    public function store(Request $request)
    {   
    try {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8', //confirmed Asegúrate de que el campo 'password_confirmation' esté presente en el formulario
    ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar la contraseña
        ]);
        return redirect()->route('user')->with('success', 'Usuario creado exitosamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al crear el usuario: ' . $e->getMessage());
    }
}
public function getUser($id)
{
    $user = User::findOrFail($id);
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
        $user = User::findOrFail($id); // Usar findOrFail para lanzar una excepción si no se encuentra

        // Actualizar los datos del usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = 'active';

        // Solo actualizar la contraseña si se proporciona
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Encriptar la contraseña
        }

        $user->update(); // Guardar los cambios

        return redirect()->route('user')->with('success', 'Usuario actualizado exitosamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
    }
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    
    // Cambiar el estado del usuario a 'inactive'
    $user->status = 'inactive'; // O 'desactive', según tu preferencia
    $user->save(); // Guardar los cambios

    return redirect()->route('user')->with('success', 'Usuario deshabilitado exitosamente.');
}

public function resetear($id)
{
    $user = User::findOrFail($id);
    return redirect()->route('user')->with('success', 'Usuario reseteado exitosamente.');
}
}