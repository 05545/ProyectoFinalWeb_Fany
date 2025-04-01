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
        Schema::create('generos', function (Blueprint $table) {
            $table->integer('id_genero', true);
            $table->boolean('estatus_genero')->nullable()->default(false)->comment('1-> Habilitado, -1-> Deshabilitado');
            $table->string('nombre_genero', 30);
            $table->text('descripcion_genero')->nullable()->default('Sin descripción...');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generos');
    }
};
