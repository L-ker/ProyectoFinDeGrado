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
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizador')
            ->constrained("users") 
            ->onUpdate('cascade')
            ->onDelete("cascade");
            $table->string("modalidad");
            $table->boolean("activo");
            $table->foreignId('ganador')
            ->constrained("users")
            ->onUpdate('cascade')
            ->onDelete("cascade")
            ->nullable()
            ->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneo');
    }
};
