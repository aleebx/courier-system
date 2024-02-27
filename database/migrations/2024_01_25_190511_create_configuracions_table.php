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
        Schema::create('configuracions', function (Blueprint $table) {
            $table->id();
            $table->boolean('carga')->default(true); // 1 = Activo, 0 = Inactivo
            $table->time('hora_carga')->nullable(); // 1 = Activo, 0 = Inactivo3
            $table->string('imagen_personal')->nullable(); // 1 = Activo, 0 = Inactivo
            $table->string('imagen_cliente')->nullable(); // 1 = Activo, 0 = Inactivo
            $table->string('imagen_motorizado')->nullable();
            $table->text('mensaje'); // 1 = Activo, 0 = Inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracions');
    }
};
