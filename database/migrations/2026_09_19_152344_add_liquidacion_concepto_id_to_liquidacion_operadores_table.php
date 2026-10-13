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
        Schema::table('liquidacion_operadores', function (Blueprint $table) {
            $table->foreignId('liquidacion_concepto_id')->constrained('liquidacion_conceptos')->cascadeOnUpdate()->restrictOnDelete()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liquidacion_operadores', function (Blueprint $table) {
            $table->dropForeignId('liquidacion_concepto_id');
        });
    }
};
