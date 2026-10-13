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
        Schema::create('operadores', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre_juridico')->unique();
            $table->string('correo_empresa');
            $table->string('nif')->unique();
            $table->string('direccion');
            $table->string('telefono')->nullable();
            $table->string('imagen_nif')->nullable();
            $table->foreignId('ciudad_id')->constrained('ciudades')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('tipo_servicio_id')->constrained('tipo_servicios')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('linea_negocio_id')->constrained('linea_negocios')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operadores');
    }
};
