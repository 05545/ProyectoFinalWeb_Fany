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
        Schema::table('streaming', function (Blueprint $table) {
            $table->foreign(['id_genero'], 'streaming_ibfk_1')->references(['id_genero'])->on('generos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('streaming', function (Blueprint $table) {
            $table->dropForeign('streaming_ibfk_1');
        });
    }
};
