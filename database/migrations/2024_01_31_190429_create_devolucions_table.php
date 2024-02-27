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
        Schema::create('devolucions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('negocio_id')->constrained('negocios'); // Negocio
            $table->foreignId('pedido_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); // pedido que se esta devolviendo
            $table->foreignId('user_id')->constrained('users'); // user que realizo la devolucion
            $table->foreignId('motorizado_id')->constrained('motorizados'); // motorizado que realizo la devolucion
            $table->timestamp('fecha_devuelto_cliente')->nullable(); // fecha de devolucion al cliente
            $table->timestamp('fecha_aceptado_motorizado')->nullable(); // fecha de devolucion aceptada por el motorizado
            $table->string('firma'); // firma de la devolucion
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devolucions');
    }
};
