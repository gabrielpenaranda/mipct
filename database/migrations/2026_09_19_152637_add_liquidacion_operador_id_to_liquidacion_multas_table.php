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
        Schema::table('liquidacion_multas', function (Blueprint $table) {
            $table->foreignId('liquidacion_operador_id')->constrained('liquidacion_operadores')->cascadeOnUpdate()->restrictOnDelete()->after('tipo_multa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liquidacion_multas', function (Blueprint $table) {
            $table->dropForeignId('liquidacion_operador_id');
        });
    }
};
