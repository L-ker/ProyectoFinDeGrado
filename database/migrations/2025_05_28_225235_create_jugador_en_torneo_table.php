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
        Schema::create('jugador_en_torneo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('torneo_id')
            ->constrained("torneos") 
            ->onUpdate('cascade')
            ->onDelete("cascade");
            $table->foreignId('user_id')
            ->constrained("users")
            ->onUpdate('cascade')
            ->onDelete("cascade");
            $table->foreignId('equipo_id')
            ->constrained("equipos_usuarios")
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
        Schema::dropIfExists('jugador_en_torneo');
    }
};
