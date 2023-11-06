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
        Schema::create('jurado_proyecto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurado_id') //Id de la division a la que pertence
            ->nullable() //Acepta valores nulos
            ->constrained('jurados')//De donde vienen los datos 
            ->cascadeOnUpdate()// cuando se actualice el dato tambien se vea en esta tabla
            ->nullOnDelete();// En caso de que se elimine lo deje en nulo 
            $table->foreignId('proyecto_id') //Id de la division a la que pertence
            ->nullable() //Acepta valores nulos
            ->constrained('proyectos')//De donde vienen los datos 
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
        Schema::dropIfExists('jurado_proyecto');
    }
};
