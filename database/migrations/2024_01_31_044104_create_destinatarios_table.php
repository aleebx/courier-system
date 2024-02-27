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
        Schema::create('destinatarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('namefull');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('id_departamento');
            $table->string('id_provincia');
            $table->foreignId('id_distrito')->constrained('distritos')->onUpdate('cascade');
            $table->string('address');
            $table->string('coordenate_x')->nullable();
            $table->string('coordenate_y')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinatario');
    }
};
