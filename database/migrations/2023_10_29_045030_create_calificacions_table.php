<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calificacions', function (Blueprint $table) {
            $table->id();
            $table->integer('calificacion_1')->nullable(); // Campo para la primera calificación
            $table->integer('calificacion_2')->nullable(); // Campo para la segunda calificación
            $table->integer('calificacion_3')->nullable(); // Campo para la tercera calificación
            $table->float('promedio')->nullable(); // Campo para almacenar el promedio de las calificaciones
            $table->foreignId('id_proyecto') //Id de la division a la que pertence
            ->nullable() //Acepta valores nulos
            ->constrained('proyectos')//De donde vienen los datos 
            ->cascadeOnUpdate()// cuando se actualice el dato tambien se vea en esta tabla
            ->nullOnDelete();// En caso de que se elimine lo deje en nulo 
            $table->foreignId('id_categoria') //Id de la division a la que pertence
            ->nullable() //Acepta valores nulos
            ->constrained('categorias')//De donde vienen los datos 
            ->cascadeOnUpdate()// cuando se actualice el dato tambien se vea en esta tabla
            ->nullOnDelete();// En caso de que se elimine lo deje en nulo 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacions');
    }
};
