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
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->id();
   
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('works')->onDelete('cascade');

            $table->unsignedBigInteger('empre_id');
            $table->foreign('empre_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('servicios')->onDelete('cascade');

            $table->date('fecha_estimada_termino');

            $table->integer('costo_total');
            $table->string('notas');
            $table->integer('factura')->default(0)->nullable();
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
        Schema::dropIfExists('cotizacions');
    }
};
