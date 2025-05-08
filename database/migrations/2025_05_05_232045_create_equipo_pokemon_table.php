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
        Schema::create('equipo_pokemon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPokemon1')
            ->constrained("pokemon") 
            ->onUpdate('cascade')
            ->onDelete("cascade");
            $table->foreignId('idPokemon2')
            ->constrained("pokemon") 
            ->onUpdate('cascade')
            ->onDelete("cascade");
            $table->timestamps();
            $table->foreignId('idPokemon3')
            ->constrained("pokemon") 
            ->onUpdate('cascade')
            ->onDelete("cascade");
            $table->foreignId('idPokemon4')
            ->constrained("pokemon") 
            ->onUpdate('cascade')
            ->onDelete("cascade");
            $table->timestamps();
            $table->foreignId('idPokemon5')
            ->constrained("pokemon") 
            ->onUpdate('cascade')
            ->onDelete("cascade");
            $table->foreignId('idPokemon6')
            ->constrained("pokemon") 
            ->onUpdate('cascade')
            ->onDelete("cascade");
            $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_pokemon');
    }
};
