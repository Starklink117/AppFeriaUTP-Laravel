<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Division;


class SeederTablaDivisiones extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $divisiones = [
            'Sistemas Automotrices',
            'Tecnlogias de la Informacion',
            'Energias Alternativas y Medio Ambiente',
            'Gastronomía',
            'Procesos Industriales',
            'Mantenimiento Industrial',
            'Mecatrónica',
            'Negocios',    
        ];

        //Este foreach agrega todos los permisos de la cadena a la tabla 
        foreach($divisiones as $division){
            Division::create(['nombre'=>$division]);
        }
    }
}
