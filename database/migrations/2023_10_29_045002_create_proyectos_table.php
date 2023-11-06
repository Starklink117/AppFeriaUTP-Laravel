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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('impacto');
            $table->string('objetivo');
            $table->string('metodologia');
            $table->string('patente');
            $table->foreignId('id_grupo') //Id de la division a la que pertence
            ->nullable() //Acepta valores nulos
            ->constrained('grupos')//De donde vienen los datos 
            ->cascadeOnUpdate()// cuando se actualice el dato tambien se vea en esta tabla
            ->nullOnDelete();// En caso de que se elimine lo deje en nulo 
            $table->foreignId('id_usuario') //Id de la division a la que pertence
            ->nullable() //Acepta valores nulos
            ->constrained('users')//De donde vienen los datos 
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
        Schema::dropIfExists('proyectos');
    }
};
