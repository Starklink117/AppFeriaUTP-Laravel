<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Spatie de los permisos
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permisos = [
            'ver-usuario','crear-usuario','editar-usuario','borrar-usuario',
            'ver-rol','crear-rol','editar-rol','borrar-rol',
            'ver-division','crear-division','editar-division','borrar-division',
            'ver-categoria','crear-categoria','editar-categoria','borrar-categoria',
            'ver-grupo','crear-grupo','editar-grupo','borrar-grupo',
            'ver-jurado','crear-jurado','editar-jurado','borrar-jurado',
            'ver-participante','crear-participante','editar-participante','borrar-participante',
            'ver-pregunta','crear-pregunta','editar-pregunta','borrar-pregunta',
            'ver-proyecto','crear-proyecto','editar-proyecto','borrar-proyecto',

        ];

        //Este foreach agrega todos los permisos de la cadena a la tabla Permission
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
