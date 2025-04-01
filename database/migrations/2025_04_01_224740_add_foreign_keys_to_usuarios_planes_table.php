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
        Schema::table('usuarios_planes', function (Blueprint $table) {
            $table->foreign(['id_usuario'], 'usuarios_planes_ibfk_1')->references(['id_usuario'])->on('usuarios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_plan'], 'usuarios_planes_ibfk_2')->references(['id_plan'])->on('planes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios_planes', function (Blueprint $table) {
            $table->dropForeign('usuarios_planes_ibfk_1');
            $table->dropForeign('usuarios_planes_ibfk_2');
        });
    }
};
