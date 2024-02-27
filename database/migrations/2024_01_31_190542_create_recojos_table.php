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
        Schema::create('recojos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motorizado_id')->constrained('motorizados'); // motorizado que realizo el recojo
            $table->foreignId('negocio_id')->constrained('negocios'); // Negocio
            $table->foreignId('pedido_id')->constrained('pedidos'); // Pedido
            $table->foreignId('user_id')->constrained('users'); // user que asigno el recojo
            $table->boolean('status')->default(true);
            $table->integer('old_motorizado_id')->nullable(); // motorizado que realizo el movimiento del recojo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recojos');
    }
};
