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
        Schema::create('usuarios_planes', function (Blueprint $table) {
            $table->integer('id_usuario_plan', true);
            $table->date('fecha_registro_plan');
            $table->date('fecha_fin_plan');
            $table->integer('id_usuario')->index('id_usuario');
            $table->integer('id_plan')->index('id_plan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_planes');
    }
};
