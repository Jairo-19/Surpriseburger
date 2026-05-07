<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResenasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('resenas', function (Blueprint $table) {
        $table->id(); 
        
        $table->unsignedBigInteger('cliente_id');

        $table->foreign('cliente_id')
              ->references('usuario_id') 
              ->on('clientes')         
              ->onDelete('cascade');

        $table->date('fecha');
        $table->text('texto');
        $table->unsignedTinyInteger('valoracion');
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
        Schema::dropIfExists('resenas_');
    }
}
