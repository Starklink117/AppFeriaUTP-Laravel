<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//Agregamos el Modelo User, Maestro
use App\Models\User; 
use App\Models\Division;

//Agregamos SPATIE
use Spatie\Permission\Models\Role;

//Agreamos las siguientes clases funciononees
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera todos los usuarios de la base de datos
        $usuarios = User::all();
        // Devuelve la vista 'usuarios.index' y pasa la lista de usuarios como datos
        return view('usuario.ver', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtiene todos los nombres de roles desde la base de datos
        $roles = Role::pluck('name', 'name')->all();
        $division = Division::pluck('nombre', 'id')->all();        // Devuelve la vista 'usuarios.crear' y pasa la lista de roles como datos
        return view('usuario.crear', compact('roles','division'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|same:confirm-password',
            'roles' => 'required',
            'id_division' => 'required',
        ]);
        // Obtiene todos los datos del formulario
        $input = $request->all();
        // Hashea la contraseña antes de almacenarla en la base de datos
        $input['password'] = Hash::make($input['password']);
        // Crea un nuevo usuario en la base de datos
        $user = User::create($input);
        // Asigna el rol especificado al nuevo usuario
        $user->assignRole($request->input('roles'));
        // Redirige a la página de índice de usuarios
        return redirect()->route('usuarios.index');
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
        // Encuentra al usuario con el ID proporcionado en la base de datos
        $user = User::find($id);
        // Obtiene todos los nombres de roles desde la base de datos
        $roles = Role::pluck('name', 'name')->all();
        // Obtiene los nombres de roles del usuario actual
        $userRole = $user->roles->pluck('name', 'name')->all();

        $divisiones = Division::pluck('nombre', 'id')->all();

        // Devuelve la vista 'usuarios.editar' y pasa los datos del usuario y roles
        return view('usuario.editar', compact('user', 'roles', 'userRole', 'divisiones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valida los datos del formulario de edición
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'id_division' => 'required',
        ]);
        // Obtiene todos los datos del formulario
        $input = $request->all();
        // Verifica si se proporcionó una nueva contraseña y la hashea
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            // Si no se proporciona una nueva contraseña, elimina el campo de contraseña del arreglo
            $input = Arr::except($input, ['password']);
        }
        // Encuentra al usuario con el ID proporcionado en la base de datos
        $user = User::find($id);
        // Actualiza los datos del usuario con los nuevos valores
        $user->update($input);
        // Borra los roles anteriores del usuario en la tabla 'model_has_roles'
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        // Asigna el rol especificado al usuario
        $user->assignRole($request->input('roles'));
        // Redirige a la página de índice de usuarios después de la actualización
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Encuentra al usuario con el ID proporcionado en la base de datos y lo elimina
        User::find($id)->delete();
        
        // Redirige a la página de índice de usuarios después de eliminar el usuario
        return redirect()->route('usuarios.index');
    }
}
