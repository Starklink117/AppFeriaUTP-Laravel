<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $preguntas = Pregunta::all();
        return view('pregunta.ver', compact('preguntas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pregunta.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'descripcion' => 'required|unique:preguntas,descripcion',
        ]);
        // Crear un nuevo registro de 'Divisione' con los datos proporcionados en la solicitud.
        Pregunta::create($request->all());
        // Redirigir al usuario a la vista de índice de divisiones después de crear con éxito.
        return redirect()->route('preguntas.index');
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
    public function edit(Pregunta $pregunta)
    {
        //
        return view('pregunta.editar', compact('pregunta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pregunta $pregunta)
    {
        // Validar el formulario de entrada, asegurando que el campo 'nombre' sea requerido y único en la tabla 'divisiones', excluyendo la división actual.
        request()->validate([
            'descripcion' => 'required|unique:preguntas,descripcion,' .$pregunta->id,
        ]);
        // Actualizar los datos de la división actual con los datos proporcionados en la solicitud.
        $pregunta->update($request->all());
        // Redirigir al usuario a la vista de índice de divisiones después de la actualización exitosa.
        return redirect()->route('preguntas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pregunta $pregunta)
    {
        // Elimina la instancia de 'Divisione' proporcionada como argumento.
        $pregunta->delete();
        // Redirige al usuario a la vista de índice de divisiones después de la eliminación exitosa.
        return redirect()->route('preguntas.index');
    }
}
