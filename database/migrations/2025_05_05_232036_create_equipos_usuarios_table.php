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
        Schema::create('equipos_usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUsuario')
            ->constrained("users") 
            ->onUpdate('cascade')
            ->onDelete("cascade");
            $table->foreignId('idEquipo')
            ->constrained("equipos_pokemon") 
            ->onUpdate('cascade')
            ->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos_usuarios');
    }
};
