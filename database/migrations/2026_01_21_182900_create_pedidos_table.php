<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->string('codigo_postal', 5); 
            $table->string('poblacion');
            $table->string('provincia');
            $table->decimal('importe', 10, 2); 
            $table->enum('forma', ['recogida', 'domicilio']);
            $table->dateTime('fecha_entrega')->nullable();
            $table->foreignId('pago_id')->constrained('pagos')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}