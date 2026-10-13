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
        Schema::create('nota_ingresos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->decimal('monto', 10, 2);
            $table->foreignId('banco_id')->constrained('bancos')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('tipo_pago_id')->constrained('tipo_pagos')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('liquidacion_operador_id')->constrained('liquidacion_operadores')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_ingresos');
    }
};
