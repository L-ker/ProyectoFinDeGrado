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
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('torneo_id')
                ->constrained('torneos')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('ronda');

            $table->foreignId('user1_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreignId('user2_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreignId('ganador_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreignId('modulo_hijo1_id')
                ->nullable()
                ->constrained('modulos')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('modulo_hijo2_id')
                ->nullable()
                ->constrained('modulos')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};
