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
        Schema::create('liquidacion_operadores', function (Blueprint $table) {
            $table->id();
            $table->string('numero_liquidacion')->unique();
            $table->string('descripcion_concepto');
            $table->string('descripcion_recargo')->nullable();
            $table->string('descripcion_multa')->nullable();
            $table->string('codigo_concepto');
            $table->string('codigo_recargo')->nullable();
            $table->string('codigo_multa')->nullable();
            $table->decimal('total_concepto', 10, 2)->default(0);
            $table->decimal('total_recargo', 10, 2)->default(0);
            $table->decimal('total_multa', 10, 2)->default(0);
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->decimal('total_liquidacion', 10, 2)->default(0);
            $table->boolean('es_pagado')->default(false);
            $table->foreignId('operador_id')->constrained('operadores')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('liquidacion_categoria_id')->constrained('liquidacion_categorias')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquidacion_operadores');
    }
};
