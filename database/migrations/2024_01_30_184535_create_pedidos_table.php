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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('negocio_id')->constrained('negocios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('motorizado_id')->constrained('motorizados');
            $table->foreignId('type_pedido_id')->constrained('type_pedido');
            $table->foreignId('seguimiento_id')->constrained('seguimientos');
            $table->timestamp('fecha_entrega');
            $table->timestamp('fecha_asignado')->nullable();
            $table->boolean('reprogramado')->default(false);
            $table->integer('motorizado_old_id')->nullable();
            $table->integer('type_recojo')->default(1);
            $table->integer('reutilizado')->nullable(); // ID DEL PEDIDO QUE SE REUTILIZO
            $table->integer('reagendado')->nullable(); // ID DEL PEDIDO QUE SE REAGENDO
            $table->decimal('servicio', 8, 2); // COSTO DEL SERVICIO
            $table->json('extra')->nullable(); // COSTO EXTRA
            $table->json('productos')->nullable(); // PRODUCTOS          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
