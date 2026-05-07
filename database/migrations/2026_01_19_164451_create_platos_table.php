<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platos', function (Blueprint $table) {
        $table->id();                       
        $table->string('nombre');            
        $table->text('descripcion')->nullable(); 
        $table->decimal('precio', 8, 2);     // Precio con 8 digitos 2 decimales
        $table->boolean('activo')->default(true); // Visible o no
        $table->timestamps();                // fecha de creacion y actualizacion de la tabla
        $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platos');
    }
}
