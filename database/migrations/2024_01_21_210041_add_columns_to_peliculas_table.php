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
        Schema::table('peliculas', function (Blueprint $table) {
            //
            $table->string('color_fondo');
            $table->string('color_texto');
            $table->string('color_botones');
            $table->string('color_extra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peliculas', function (Blueprint $table) {
            //
        });
    }
};
