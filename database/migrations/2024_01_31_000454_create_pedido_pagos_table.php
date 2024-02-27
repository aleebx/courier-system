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
        Schema::create('pedido_pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade'); // pedido que se esta pagando
            $table->foreignId('metodo_pago_id')->constrained('metodo_pago'); // metodo de pago
            $table->decimal('monto', 8, 2); // monto a pagar
            $table->tinyInteger('status')->default(1); // 1: pendiente, 2: pagado, 3: anulado      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_pago');
    }
};
