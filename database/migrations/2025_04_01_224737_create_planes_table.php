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
        Schema::create('planes', function (Blueprint $table) {
            $table->integer('id_plan', true);
            $table->boolean('estatus_plan')->nullable()->default(false)->comment('1-> Habilitado, -1-> Deshabilitado');
            $table->string('nombre_plan', 30);
            $table->decimal('precio_plan', 10);
            $table->boolean('cantidad_limite_plan');
            $table->boolean('tipo_plan')->comment('8-> Semanal, 16-> Mensual, 32-> Anual');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes');
    }
};
