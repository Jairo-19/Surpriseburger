<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponesTable extends Migration
{
    public function up()
    {
        Schema::create('cupones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('imagenes')->nullable();
            $table->integer('puntos_necesarios');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cupones');
    }
}
