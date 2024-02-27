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
        Schema::create('pedido_incidencias_respuesta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_incidencia_id')->constrained('pedido_incidencias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade'); // Usuario que responde la incidencia
            $table->foreignId('respuesta_id')->constrained('respuestas')->onUpdate('cascade');
            $table->string('foto')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_incidencias_respuesta');
    }
};
