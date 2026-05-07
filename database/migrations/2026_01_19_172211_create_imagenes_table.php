<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
    Schema::create('imagenes', function (Blueprint $table) {
        $table->id();
        $table->string('ruta');              
        $table->foreignId('plato_id')  //clave foranea     
              ->constrained('platos')  //tabla a la que referencia
              ->onDelete('cascade');   //esto hace que si se borra un plato, se borren sus imagenes
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagenes');
    }
}
