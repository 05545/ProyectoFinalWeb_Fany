<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alquileres', function (Blueprint $table) {
            $table->integer('id_alquiler', true);
            $table->date('fecha_inicio_alquiler');
            $table->date('fecha_fin_alquiler');
            $table->boolean('estatus_alquiler')->nullable()->default(false)->comment('-1-> En proceso, 1-> Culminado');
            $table->integer('id_streaming')->index('id_streaming');
            $table->integer('id_usuario')->index('id_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquileres');
    }
};
