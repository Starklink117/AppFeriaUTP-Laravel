<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Calificacion;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class CalificarApiController extends Controller
{

    public function show(string $id_proyecto)
    {
        $proyecto = Proyecto::find($id_proyecto);

        if (!$proyecto) {
            return response()->json(['error' => 'El proyecto no existe'], 404);
        }

        if ($proyecto->categoria) {
            $categoria = $proyecto->categoria; 
            $preguntas = $categoria->preguntas;

            return response()->json(['preguntas' => $preguntas, 'id_proyecto' => $id_proyecto, 'nombreProyecto' => $proyecto->nombre]);
        } else {
            return response()->json(['error' => 'El proyecto no tiene una categoría asociada'], 404);
        }
    }


    public function store(Request $request)
    {
        $id_proyecto = $request->input('id_proyecto');
        $calificacion = Calificacion::where('id_proyecto', $id_proyecto)->first();

        if ($calificacion->calificacion_1 && $calificacion->calificacion_2 && $calificacion->calificacion_3) {
            return response()->json(['error' => 'Ya se han registrado las tres calificaciones'], 400);
        }
        
        $resultado = $request->input('resultado');
    
        if (!$calificacion) {
            $calificacion = new Calificacion();
            $calificacion->id_proyecto = $id_proyecto;
        }
    
        if (!$calificacion->calificacion_1) {
            $calificacion->calificacion_1 = $resultado;
        } elseif (!$calificacion->calificacion_2) {
            $calificacion->calificacion_2 = $resultado;
        } elseif (!$calificacion->calificacion_3) {
            $calificacion->calificacion_3 = $resultado;
        }
    
        $promedio = ($calificacion->calificacion_1 + $calificacion->calificacion_2 + $calificacion->calificacion_3) / 3;
        $calificacion->promedio = $promedio;
    
        $calificacion->save();
    
        return response()->json(['message' => 'Calificación guardada con éxito'], 200);
    }
}
