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
        Schema::create('videos', function (Blueprint $table) {
            $table->integer('id_video', true);
            $table->boolean('estatus_video')->nullable()->default(false)->comment('1-> Disponible, -1-> No Disponible');
            $table->string('video', 70)->comment('nombre_video.mp3');
            $table->string('nombre_temporada', 70)->nullable()->comment('Parte 1, ');
            $table->boolean('video_temporada')->nullable()->comment('Temporada 1, Temporada 2, Temporada 3');
            $table->boolean('capitulo_temporada')->nullable()->comment('Capitulo 1, Episodeo 1');
            $table->text('descripcion_capitulo_temporada')->nullable()->comment('Descripción...');
            $table->integer('id_streaming')->index('id_streaming');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
