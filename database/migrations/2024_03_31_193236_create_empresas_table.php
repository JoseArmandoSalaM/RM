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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('dueño');
            $table->string('nombre_empresa');
            $table->text('numero_telefono');
            $table->string('estado');
            $table->string('sector');
            $table->string('correo_electronico')->nullable();
            $table->string('sitio_web')->nullable();
            $table->date('fecha_inicio_asociacion')->nullable();
            $table->text('notas')->nullable();
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
        Schema::dropIfExists('empresas');
    }
};
