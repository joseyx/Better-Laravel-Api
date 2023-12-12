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
        Schema::create('sala_de_cine', function (Blueprint $table) {
            $table->string('nombre');
            $table->integer('capacidad');
            $table->date('desde');
            $table->date('hasta');
            $table->string('tipo');
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sala_de_cine');
    }
};
