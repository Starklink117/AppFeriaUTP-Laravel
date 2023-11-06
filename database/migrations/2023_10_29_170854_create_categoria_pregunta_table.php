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
        Schema::create('categoria_pregunta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id') //Id de la categoria a la que pertence
            ->nullable() //Acepta valores nulos
            ->constrained('categorias')//De donde vienen los datos 
            ->cascadeOnUpdate()// cuando se actualice el dato tambien se vea en esta tabla
            ->nullOnDelete();// En caso de que se elimine lo deje en nulo 
            $table->foreignId('pregunta_id') //Id de la division a la que pertence
            ->nullable() //Acepta valores nulos
            ->constrained('preguntas')//De donde vienen los datos 
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
        Schema::dropIfExists('categoria_pregunta');
    }
};
