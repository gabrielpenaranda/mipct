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
        Schema::create('liquidacion_conceptos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre')->unique();
            $table->string('descripcion');
            $table->decimal('monto', 10, 2);
            $table->foreignId('linea_negocio_id')->constrained('linea_negocios')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('liquidacion_categoria_id')->constrained('liquidacion_categorias')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquidacion_conceptos');
    }
};
