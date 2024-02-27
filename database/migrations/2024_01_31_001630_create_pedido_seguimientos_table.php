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
        Schema::create('pedido_seguimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade'); // pedido que se esta siguiendo
            $table->foreignId('user_id')->constrained('users'); // user que realizo el seguimiento
            $table->string('id_seguimiento'); // seguimiento de la empresa de envio
            $table->string('observacion')->nullable(); // observacion del seguimiento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_seguimiento');
    }
};
