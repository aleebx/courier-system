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
        Schema::create('pedido_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade')->onUpdate('cascade'); // pedido que se esta detallando          
            $table->string('detalle'); // detalle del pedido
            $table->decimal('monto_cobrar', 8, 2); // monto a cobrar
            $table->foreignId('metodo_pago_id')->constrained('metodo_pago'); // metodo de pago
            $table->string('observacion')->nullable(); // observacion del pedido
            $table->tinyInteger('type_paquete')->default(1); // 1: paquete, 2: sobre
            $table->decimal('medida_largo', 8, 2)->nullable(); // medida del paquete
            $table->decimal('medida_ancho', 8, 2)->nullable(); // medida del paquete
            $table->decimal('medida_alto', 8, 2)->nullable(); // medida del paquete
            $table->decimal('medida_peso', 8, 2)->nullable(); // medida del paquete
            $table->string('photo')->nullable(); // foto de entrega del paquete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_detalle');
    }
};
