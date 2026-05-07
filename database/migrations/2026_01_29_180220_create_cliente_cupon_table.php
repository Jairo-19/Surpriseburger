<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteCuponTable extends Migration
{
    public function up()
    {
        Schema::create('cliente_cupon', function (Blueprint $table) {
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('cupon_id');

            $table->foreign('cliente_id')
                  ->references('usuario_id')
                  ->on('clientes')
                  ->onDelete('cascade');

            $table->foreign('cupon_id')
                  ->references('id')
                  ->on('cupones')
                  ->onDelete('cascade');

            $table->primary(['cliente_id', 'cupon_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cliente_cupon');
    }
}
