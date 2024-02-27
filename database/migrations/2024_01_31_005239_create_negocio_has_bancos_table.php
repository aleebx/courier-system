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
        Schema::create('negocio_has_bancos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('negocio_id')->constrained('negocios'); // Negocio
            $table->foreignId('negocio_banco_id')->constrained('negocio_banco')->onDelete('cascade'); // Banco
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocio_has_banco');
    }
};
