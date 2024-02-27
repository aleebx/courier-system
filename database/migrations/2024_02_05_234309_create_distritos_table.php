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
        Schema::create('distritos', function (Blueprint $table) {
            $table->id('id');
            $table->string('name'); // Nombre del distrito
            $table->string('dias')->default('L-S'); // Dias a los que va al distrito
            $table->boolean('status')->default(true); // 1 = Activo, 0 = Inactivo
            $table->string('provincia_id'); // Provincia a la que pertenece el distrito
            $table->string('departamento_id'); // Departamento al que pertenece el distrito
            $table->decimal('tarifa', 8, 2)->nullable(); // Costo de envío del distrito
            $table->decimal('tarifa_motorizado', 8, 2)->nullable(); // Costo de envío express del distrito
            $table->string('detalle')->nullable(); // Costo de envío especial del distrito
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distritos');
    }
};
