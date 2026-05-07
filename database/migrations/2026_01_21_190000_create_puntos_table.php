<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('puntos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')
                  ->references('usuario_id')
                  ->on('clientes')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('cupon_id')->nullable();
            $table->foreign('cupon_id')
                  ->references('id')
                  ->on('cupones')
                  ->onDelete('set null');

            $table->integer('cantidad_puntos');
            $table->string('concepto');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('puntos');
    }
}
