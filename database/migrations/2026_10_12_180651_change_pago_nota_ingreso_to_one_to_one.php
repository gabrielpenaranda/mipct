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
        Schema::table('pagos', function (Blueprint $table) {
            $table->foreignId('nota_ingreso_id')->nullable()->constrained('nota_ingresos')->cascadeOnUpdate()->nullOnDelete()->after('tipo_pago_id');
        });

        Schema::dropIfExists('pagables');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeignId('nota_ingreso_id');
        });

        Schema::create('pagables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pago_id')->constrained('pagos')->cascadeOnUpdate()->restrictOnDelete();
            $table->morphs('pagable');
            $table->decimal('monto_aplicado', 10, 2)->default(0);
            $table->timestamps();
        });
    }
};
