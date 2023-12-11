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
        Schema::create('full_user_data', function (Blueprint $table) {
            $table->string('lastName');
            $table->string('cedula');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('estado');
            $table->string('foto');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('full_user_data');
    }
};
