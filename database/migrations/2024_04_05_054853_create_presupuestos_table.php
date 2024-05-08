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
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cotizacion_id');
            $table->foreign('cotizacion_id')->references('id')->on('cotizacions')->onDelete('cascade');

            $table->string('descripcion');
            $table->integer('cantidad');
            $table->string('unidad');
            $table->integer('costo_unitario');
            $table->integer('importe');
            $table->integer('utilidad')->nullable();
            $table->integer('financiamiento')->nullable();
            $table->integer('riesgo')->nullable();
            $table->integer('costo_total');
            

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
        Schema::dropIfExists('presupuestos');
    }
};
