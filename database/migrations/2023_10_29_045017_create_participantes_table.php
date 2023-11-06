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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidopaterno');
            $table->string('apellidomaterno');
            $table->string('matricula');
            $table->string('sexo');
            $table->foreignId('id_division') //Id de la division a la que pertence
                ->nullable() //Acepta valores nulos
                ->constrained('divisions')//De donde vienen los datos 
                ->cascadeOnUpdate()// cuando se actualice el dato tambien se vea en esta tabla
                ->nullOnDelete();// En caso de que se elimine lo deje en nulo 
            $table->foreignId('id_proyecto') //Id de la division a la que pertence
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
        Schema::dropIfExists('participantes');
    }
};
