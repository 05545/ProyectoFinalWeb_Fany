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
        Schema::create('pagos', function (Blueprint $table) {
            $table->integer('id_pago', true);
            $table->date('fecha_registro_pago');
            $table->boolean('estatus_pago')->nullable()->default(false)->comment('-1: Rechazado, 0: Pendiente, 1: Aceptado');
            $table->decimal('monto_pago', 10);
            $table->string('tarjeta_pago', 32);
            $table->integer('id_usuario')->index('id_usuario');
            $table->integer('id_plan')->index('id_plan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
