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
        Schema::create('motorizados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('namefull');
            $table->string('phone');
            $table->boolean('status')->default(true);
            $table->tinyInteger('type_document');
            $table->string('document');
            $table->string('photo_document')->nullable();
            $table->string('id_departamento');
            $table->string('id_provincia');
            $table->string('id_distrito');
            $table->string('address');
            $table->string('coordenada_x')->nullable();
            $table->string('coordenada_y')->nullable();
            $table->string('address');
            $table->json('frecuencia')->nullable();
            $table->string('placa')->nullable();
            $table->string('color')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->string('photo')->nullable();
            $table->timestamp('license_expiration');
            $table->string('photo_license')->nullable();
            $table->timestamp('soat_expiration');
            $table->string('photo_soat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motorizados');
    }
};
