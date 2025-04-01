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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('id_usuario', true);
            $table->boolean('estatus_usuario')->nullable()->default(false)->comment('1-> Habilitado, -1-> Deshabilitado');
            $table->string('nombre_usuario', 50);
            $table->string('ap_usuario', 50);
            $table->string('am_usuario', 50)->nullable();
            $table->boolean('sexo_usuario')->comment('0:Femenino, 1: Masculino');
            $table->string('email_usuario', 70);
            $table->string('password_usuario', 64);
            $table->string('imagen_usuario', 100)->nullable();
            $table->integer('id_rol')->index('id_rol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
