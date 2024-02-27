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
        Schema::create('type_pedido', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del tipo de pedido
            $table->boolean('status')->default(true); // 1 = Activo, 0 = Inactivo
            $table->decimal('extra', 8, 2)->default(0); // Costo extra del tipo de pedido
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_pedido');
    }
};
