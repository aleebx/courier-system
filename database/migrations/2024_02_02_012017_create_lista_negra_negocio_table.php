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
        Schema::create('lista_negra_negocio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destinatario_id')->constrained('destinatario'); // Negocio
            $table->string('motivo'); // motivo por el cual se agrego a la lista negra
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_negra_negocio');
    }
};
