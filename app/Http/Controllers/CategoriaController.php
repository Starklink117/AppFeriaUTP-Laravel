<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

use App\Models\Division;
use App\Models\Pregunta;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categoria.ver', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $division = Division::pluck('nombre', 'id')->all();
        $preguntas = Pregunta::pluck('descripcion', 'id');

        return view('categoria.crear', compact('division','preguntas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validar el formulario de entrada, asegurando que el campo 'nombre' sea requerido y único en la tabla 'carreras'.
        request()->validate([
            'nombre' => 'required',
            'id_division' => 'required',
            'preguntas'=> 'required',
        ]);
        // Crear un nuevo registro de 'Carrera' con los datos proporcionados en la solicitud.
       $categoria = Categoria::create($request->all());

       $categoria->preguntas()->sync($request->input('preguntas',[]));
        // Redirigir al usuario a la vista de índice de carreras después de crear con éxito.
        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        $division = Division::pluck('nombre', 'id')->all();
        $preguntas = Pregunta::pluck('descripcion', 'id');
        $categoria->load('preguntas'); // Carga las preguntas relacionadas con la categoría

        // Retorna la vista 'carreras.edit' y pasa la carrera a editar y las divisiones como datos
        return view('categoria.editar', compact('categoria', 'division', 'preguntas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        // Validar el formulario de entrada, asegurando que el campo 'nombre' sea requerido y único en la tabla 'carreras', excluyendo la carrera actual.
        request()->validate([
            'nombre' => 'required',
            'id_division' => 'required',
            'preguntas' => 'required',
        ]);

        // Actualizar los datos de la categoría actual con los datos proporcionados en la solicitud.
    $categoria->update($request->all());

    // Sincronizar las preguntas asociadas a la categoría
    $categoria->preguntas()->sync($request->input('preguntas', []));
    
        // Redirigir al usuario a la vista de índice de carreras después de la actualización exitosa.
        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
    // Eliminar la relación de muchos a muchos con las preguntas
    $categoria->preguntas()->detach();

    // Eliminar la categoría
    $categoria->delete();
        return redirect()->route('categorias.index');
    }
}
