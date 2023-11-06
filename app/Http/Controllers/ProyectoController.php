<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Categoria;
use App\Models\Division;
use App\Models\Proyecto;
use App\Models\Grupo;
use App\Models\Participante;
use App\Models\Calificacion;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::all();
        return view('proyecto.ver', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $userDivisionId = $user->id_division;
    
        $categoria = Categoria::where('id_division', $userDivisionId)->pluck('nombre', 'id')->all();
    
        $division = Division::pluck('nombre','id');
        $grupo = Grupo::pluck('nombre', 'id');
        $usuario = $user->name;


        return view('proyecto.crear', compact('categoria', 'usuario', 'division', 'grupo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        DB::beginTransaction();

        try {

            $request->validate([
                'nombre' => 'required|max:200',
                'descripcion' => 'required|max:200',
                'impacto' => 'required|max:200',
                'objetivo' => 'required|max:200',
                'metodologia' => 'required',
                'patente' => 'required',
                'id_categoria' => 'required',
                'id_grupo' => 'required',

                
                // Reglas de validación para los participantes
                'participantes' => 'required|array|min:1', // Asegura que al menos haya un participante
                'participantes.*.nombre' => 'required',
                'participantes.*.apellidopaterno' => 'required',
                'participantes.*.apellidomaterno' => 'required',
                'participantes.*.matricula' => 'required|regex:/^[A-Za-z0-9]{10}$/',
                'participantes.*.sexo' => 'required',

            ]);

            $idUsuario = Auth::id();;


            $proyecto = Proyecto::create(array_merge($request->only(['nombre', 'descripcion', 'impacto', 'objetivo', 'metodologia', 'patente', 'id_categoria', 'id_grupo']), ['id_usuario' => $idUsuario]));

            // Resto del código para participantes y otras operaciones

            // Obtener la categoría seleccionada
            $categoriaSeleccionada = Categoria::find($request->id_categoria);

            // Obtener la division asociada a la categoría
            $divisionSeleccionada = $categoriaSeleccionada->division;

            $participantes = $request->input('participantes');

            if ($participantes) {
                foreach ($participantes as $participante) {
                    Participante::create([
                        'nombre' => $participante['nombre'],
                        'apellidopaterno' => $participante['apellidopaterno'],
                        'apellidomaterno' => $participante['apellidomaterno'],
                        'matricula' => $participante['matricula'],
                        'sexo' => $participante['sexo'],
                        'id_division' => $divisionSeleccionada->id,
                        'id_proyecto' => $proyecto->id,
                    ]);
                }
            }

            Calificacion::create([
                'id_proyecto'=>  $proyecto->id,
                'id_categoria' => $categoriaSeleccionada->id,
            ]);

            DB::commit();
            return redirect()->route('proyectos.index');

            // Redireccionar a alguna vista o ruta adecuada después de guardar exitosamente
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage(); // Obtener el mensaje de error
            return redirect()->back()->with('error', $errorMessage); // Redirigir de vuelta al formulario con el mensaje de error

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        $user = Auth::user();
        $userDivisionId = $user->id_division;
    
        $categoria = Categoria::where('id_division', $userDivisionId)->pluck('nombre', 'id')->all();
        $division = Division::pluck('nombre', 'id');
        $grupo = Grupo::pluck('nombre', 'id');
        $usuario = $user->name;
    
        return view('proyecto.editar', compact('proyecto', 'categoria', 'usuario', 'division', 'grupo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'nombre' => 'required|max:200',
                'descripcion' => 'required|max:200',
                'impacto' => 'required|max:200',
                'objetivo' => 'required|max:200',
                'metodologia' => 'required',
                'patente' => 'required',
                'id_categoria' => 'required',
                'id_grupo' => 'required',

                
                // Reglas de validación para los participantes
                'participantes' => 'required|array|min:1', // Asegura que al menos haya un participante
                'participantes.*.nombre' => 'required',
                'participantes.*.apellidopaterno' => 'required',
                'participantes.*.apellidomaterno' => 'required',
                'participantes.*.matricula' => 'required|regex:/^[A-Za-z0-9]{10}$/',
                'participantes.*.sexo' => 'required',
            ]);
    
            $proyecto->update($request->only(['nombre', 'descripcion', 'impacto', 'objetivo', 'metodologia', 'patente', 'id_categoria', 'id_grupo']));
    
            
            // Obtener la categoría seleccionada
            $categoriaSeleccionada = Categoria::find($request->id_categoria);

            // Obtener la division asociada a la categoría
            $divisionSeleccionada = $categoriaSeleccionada->division;

            $participantes = $request->input('participantes');

            if ($participantes) {
                // Elimina los participantes antiguos asociados con el proyecto
                Participante::where('id_proyecto', $proyecto->id)->delete();
    
                // Agrega los nuevos participantes
                foreach ($participantes as $participante) {
                    Participante::create([
                        'nombre' => $participante['nombre'],
                        'apellidopaterno' => $participante['apellidopaterno'],
                        'apellidomaterno' => $participante['apellidomaterno'],
                        'matricula' => $participante['matricula'],
                        'sexo' => $participante['sexo'],
                        'id_division' => $proyecto->categoria->division->id,
                        'id_proyecto' => $proyecto->id,
                    ]);
                }
            }

            Calificacion::where('id_proyecto', $proyecto->id)->delete();

            Calificacion::create([
                'id_proyecto'=>  $proyecto->id,
                'id_categoria' => $categoriaSeleccionada->id,
            ]);
    
            DB::commit();
            return redirect()->route('proyectos.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        //
        Participante::where('id_proyecto', $proyecto->id)->delete();
        Calificacion::where('id_proyecto', $proyecto->id)->delete();
        $proyecto -> delete();

        return redirect()->route('proyectos.index');

    }
}
