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
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->boolean('status')->default(true);
            $table->tinyInteger('type_negocio');
            $table->tinyInteger('type_document');
            $table->string('document');
            $table->string('id_departamento');
            $table->string('id_provincia');
            $table->string('id_distrito');
            $table->string('address');
            $table->string('coordenate_x')->nullable();
            $table->string('coordenate_y')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('pos')->default(true);
            $table->string('name_encargado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocios');
    }
};
