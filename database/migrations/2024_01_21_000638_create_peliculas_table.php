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
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('sinopsis');
            $table->string('poster');
            $table->date('fecha_estreno');
            $table->timestamps();
            $table->string('color_fondo');
            $table->string('color_texto');
            $table->string('color_botones');
            $table->string('color_extra1');
            $table->string('color_extra2');
            $table->string('genero');
            $table->string('clasificacion');
            $table->string('duracion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peliculas');
    }
};
