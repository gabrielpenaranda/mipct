<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'numero_liquidacion',
    'concepto',
    'recargo',
    'multa',
    'total_concepto',
    'total_recargo',
    'total_multa',
    'fecha',
    'fecha_hasta',
    'total_liquidacion',
    'es_pagado',
    'operador_id',
    'user_id',
    'liquidacion_concepto_id',
])]
class LiquidacionOperador extends Model
{
    protected $table = 'liquidacion_operadores';

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'fecha_hasta' => 'date',
            'total_concepto' => 'decimal:2',
            'total_recargo' => 'decimal:2',
            'total_multa' => 'decimal:2',
            'total_liquidacion' => 'decimal:2',
            'es_pagado' => 'boolean',
        ];
    }

    public function operador(): BelongsTo
    {
        return $this->belongsTo(Operador::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function concepto(): BelongsTo
    {
        return $this->belongsTo(LiquidacionConcepto::class, 'liquidacion_concepto_id');
    }

    public function multas(): HasMany
    {
        return $this->hasMany(LiquidacionMulta::class);
    }

    public function recargos(): HasMany
    {
        return $this->hasMany(LiquidacionRecargo::class);
    }
}
