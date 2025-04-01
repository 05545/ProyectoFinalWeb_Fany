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
        Schema::table('alquileres', function (Blueprint $table) {
            $table->foreign(['id_usuario'], 'alquileres_ibfk_1')->references(['id_usuario'])->on('usuarios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_streaming'], 'alquileres_ibfk_2')->references(['id_streaming'])->on('streaming')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alquileres', function (Blueprint $table) {
            $table->dropForeign('alquileres_ibfk_1');
            $table->dropForeign('alquileres_ibfk_2');
        });
    }
};
