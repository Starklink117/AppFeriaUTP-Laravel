<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;


class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtiene todas las divisiones de la base de datos
        $divisiones = Division::all();
        // Retorna la vista 'divisiones.index' y pasa las divisiones como datos
        return view('division.ver', compact('divisiones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna la vista 'divisiones.create' para mostrar el formulario de creación
        return view('division.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar el formulario de entrada, asegurando que el campo 'nombre' sea requerido y único en la tabla 'divisiones'.
        request()->validate([
            'nombre' => 'required|unique:divisions,nombre',
        ]);
        // Crear un nuevo registro de 'Divisione' con los datos proporcionados en la solicitud.
        Division::create($request->all());
        // Redirigir al usuario a la vista de índice de divisiones después de crear con éxito.
        return redirect()->route('divisiones.index');
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
    public function edit(Division $divisione)
    {
        //
        return view('division.editar', compact('divisione'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $divisione)
    {
        // Validar el formulario de entrada, asegurando que el campo 'nombre' sea requerido y único en la tabla 'divisiones', excluyendo la división actual.
        request()->validate([
            'nombre' => 'required|unique:divisions,nombre,' .$divisione->id,
        ]);
        // Actualizar los datos de la división actual con los datos proporcionados en la solicitud.
        $divisione->update($request->all());
        // Redirigir al usuario a la vista de índice de divisiones después de la actualización exitosa.
        return redirect()->route('divisiones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $divisione)
    {
        // Elimina la instancia de 'Divisione' proporcionada como argumento.
        $divisione->delete();
        // Redirige al usuario a la vista de índice de divisiones después de la eliminación exitosa.
        return redirect()->route('divisiones.index');
    }
}
