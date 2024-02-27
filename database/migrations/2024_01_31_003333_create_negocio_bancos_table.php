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
        Schema::create('negocio_bancos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // id del usuario que registra el banco
            $table->foreignId('banco_id')->constrained('banco'); // id del banco
            $table->string('numero_cuenta'); // numero de cuenta
            $table->tinyText('tipo_cuenta'); // (ahorros, corriente, etc)     
            $table->string('titular'); // nombre del titular de la cuenta
            $table->string('type_document'); // tipo de documento del titular
            $table->string('document'); // documento del titular
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocio_banco');
    }
};
