<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlergenoPlatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
   Schema::create('alergeno_plato', function (Blueprint $table) {
    $table->foreignId('plato_id')->constrained('platos')->onDelete('cascade');
    $table->foreignId('alergeno_id')->constrained('alergenos')->onDelete('cascade');

    //evita duplicados 
    $table->primary(['plato_id', 'alergeno_id']);
});
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alergeno_plato');
    }
}
