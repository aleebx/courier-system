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
        Schema::create('provincias', function (Blueprint $table) {
            $table->string('id', 4)->unique()->primary();
            $table->string('name'); // Nombre de la provincia
            $table->boolean('status')->default(true); // 1 = Activo, 0 = Inactivo
            $table->string('departamento_id'); // ID del departamento al que pertenece la provincia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('province');
    }
};
