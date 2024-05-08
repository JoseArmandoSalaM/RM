<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encargados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_entrega');
            $table->date('fecha_devolucion');
            $table->integer('cantidad_prestada');
            $table->text('entregado');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('works')->onDelete('cascade');
            $table->unsignedBigInteger('herramienta_id');
            $table->foreign('herramienta_id')->references('id')->on('herramientas')->onDelete('cascade');
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
        Schema::dropIfExists('encargados');
    }
};
