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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('monto', 10, 2);
            $table->string('numero_recibo');
            $table->foreignId('banco_id')->constrained('bancos')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('tipo_pago_id')->constrained('tipo_pagos')->cascadeOnUpdate()->restrictOnDelete();
            $table->unique(['numero_recibo', 'banco_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
