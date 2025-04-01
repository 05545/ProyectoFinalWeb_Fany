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
        Schema::create('streaming', function (Blueprint $table) {
            $table->integer('id_streaming', true);
            $table->boolean('estatus_streaming')->nullable()->default(false)->comment('1-> Habilitado, -1-> Deshabilitado');
            $table->string('nombre_streaming', 50);
            $table->date('fecha_lanzamiento_streaming');
            $table->time('duracion_streaming')->nullable()->comment('Peliculas');
            $table->boolean('temporadas_streaming')->nullable()->comment('temporadas');
            $table->string('caratula_streaming', 50)->comment('image_caratula.png');
            $table->string('trailer_streaming', 70)->comment('trailer_streaming.mp3');
            $table->string('clasificacion_streaming', 3)->comment('AA: Infantil, A: Todo Público, B: Mayores de 12, B15: Mayores de 15, C: Solo Mayores 18, D: Exclusiva Adultos');
            $table->text('sipnosis_streaming')->nullable()->default('Sin descripción por el momento');
            $table->date('fecha_estreno_streaming');
            $table->integer('id_genero')->index('id_genero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streaming');
    }
};
