<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Proyecto;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calificaciones = Calificacion::all();
        return view('calificacion.ver', compact('calificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Calificacion $calificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calificacion $calificacione)
    {
        $proyecto = Proyecto::pluck('nombre', 'id')->all();
        $categoria = Categoria::pluck('nombre', 'id')->all();

        // Retorna la vista 'carreras.edit' y pasa la carrera a editar y las divisiones como datos
        return view('calificacion.editar', compact('calificacione', 'proyecto', 'categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calificacion $calificacione)
    {
        request()->validate([
            'calificacion_1' => 'required|numeric',
            'calificacion_2' => 'required|numeric',
            'calificacion_3' => 'required|numeric',
            'promedio' => 'required|numeric'
        ]);
        

        // Actualizar los datos de la categoría actual con los datos proporcionados en la solicitud.
        $calificacione->update($request->all());
    
        // Redirigir al usuario a la vista de índice de carreras después de la actualización exitosa.
        return redirect()->route('calificaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calificacion $calificacion)
    {

        // Eliminar la calificacion
        $calificacion->delete();
        return redirect()->route('categorias.index');
    }
}
