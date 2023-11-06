<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Calificacion;
use Illuminate\Support\Facades\Redirect;

class CalificarController extends Controller
{

    public function show(string $id_proyecto)
    {
        $proyecto = Proyecto::find($id_proyecto);
        $nombreProyecto = $proyecto->nombre;

        if (!$proyecto) {
            // Manejo del caso en el que el proyecto no existe
            abort(404, 'El proyecto no existe');
        }

        // Verifica si el proyecto existe antes de acceder a la relación
        if ($proyecto->categoria) {
            $categoria = $proyecto->categoria; 

            // Luego, puedes obtener todas las preguntas relacionadas con esa categoría
            $preguntas = $categoria->preguntas;

            return view('calificar.calificacion', compact('preguntas','id_proyecto', 'nombreProyecto'));
        } else {
            // Manejo del caso en el que la categoría no existe para el proyecto
            abort(404, 'El proyecto no tiene una categoría asociada');
        }
    }


    public function store(Request $request){


        $id_proyecto = $request->input('id_proyecto');
        $calificacion = Calificacion::where('id_proyecto', $id_proyecto)->first();

            // Verificar si ya se tienen todas las calificaciones
    if ($calificacion->calificacion_1 && $calificacion->calificacion_2 && $calificacion->calificacion_3) {
        return redirect()->back()->with('error', 'Ya se han registrado las tres calificaciones');
    }
    
        // Obtener el resultado del formulario
        $resultado = $request->input('resultado');
    
        // Lógica para determinar la calificación a actualizar y recalcular el promedio
        if (!$calificacion) {
            $calificacion = new Calificacion();
            $calificacion->id_proyecto = $id_proyecto;
        }
    
        // Verifica si la calificación_1 está en nulo o 0
        if (!$calificacion->calificacion_1) {
            $calificacion->calificacion_1 = $resultado;
        }
        // Verifica si la calificación_2 está en nulo o 0
        elseif (!$calificacion->calificacion_2) {
            $calificacion->calificacion_2 = $resultado;
        }
        // Verifica si la calificación_3 está en nulo o 0
        elseif (!$calificacion->calificacion_3) {
            $calificacion->calificacion_3 = $resultado;
        }
    
        // Recalcular el promedio
        $promedio = ($calificacion->calificacion_1 + $calificacion->calificacion_2 + $calificacion->calificacion_3) / 3;
        $calificacion->promedio = $promedio;
    
        // Guardar la calificación
        $calificacion->save();
    
        return redirect()->route('dashboard')->with('success', 'Calificación guardada con éxito');
    }
}
