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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('usuario')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
        // Schema::create('puntuaciones', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('puntuacion');
        //     $table->foreignId('usuarios_id')
        //     ->constrained("usuarios") 
        //     ->onUpdate('cascade')
        //     ->onDelete("cascade");
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};