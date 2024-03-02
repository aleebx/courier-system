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
        Schema::create('pedidos_recojo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('motorizado_id')->constrained('motorizado')->onUpdate('cascade');
            $table->foreignId('negocio_id')->constrained('negocio')->onUpdate('cascade');
            $table->integer('motorizado_id_old')->constrained('motorizado')->onUpdate('cascade');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_recojo');
    }
};
