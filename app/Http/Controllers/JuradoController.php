<?php

namespace App\Http\Controllers;

use App\Models\Jurado;
use App\Models\User;
use App\Models\Proyecto;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

class JuradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jurados = Jurado::with(['proyectos'])->get();
        $juradosjson = $jurados->toJson();
        return view('jurado.ver', compact('jurados', 'juradosjson'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proyectos = Proyecto::pluck('nombre', 'id');

        $usuario = User::role('Jurado')->pluck('name', 'id')->all();

        return view('jurado.crear', compact('proyectos','usuario'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // Validar el formulario de entrada, asegurando que el campo 'nombre' sea requerido y único en la tabla 'carreras'.
            request()->validate([
                'id_usuario' => 'required',
                'proyectos'=> 'required',
            ]);
            // Crear un nuevo registro de 'Carrera' con los datos proporcionados en la solicitud.
           $jurado = Jurado::create($request->all());
    
           $jurado->proyectos()->sync($request->input('proyectos',[]));
            // Redirigir al usuario a la vista de índice de carreras después de crear con éxito.
            return redirect()->route('jurados.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurado $jurado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurado $jurado)
    {
        $proyectos = Proyecto::pluck('nombre', 'id');
        $jurado->load('proyectos'); // Carga las preguntas relacionadas con la categoría


        $usuario = User::role('Jurado')->pluck('name', 'id')->all();

        return view('jurado.editar', compact('proyectos','usuario','jurado'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurado $jurado)
    {
        request()->validate([
            'id_usuario' => 'required',
            'proyectos' => 'required',
        ]);

        // Actualizar los datos de la categoría actual con los datos proporcionados en la solicitud.
    $jurado->update($request->all());

    // Sincronizar las preguntas asociadas a la categoría
    $jurado->proyectos()->sync($request->input('proyectos', []));
    
        // Redirigir al usuario a la vista de índice de carreras después de la actualización exitosa.
        return redirect()->route('jurados.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurado $jurado)
    {
        // Eliminar la relación de muchos a muchos con las preguntas
        $jurado->proyectos()->detach();

        // Eliminar la categoría
        $jurado->delete();
            return redirect()->route('jurados.index');
    }
}
