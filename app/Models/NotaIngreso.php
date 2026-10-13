<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['fecha_desde', 'fecha_hasta', 'monto', 'banco_id', 'tipo_pago_id', 'liquidacion_operador_id'])]
class NotaIngreso extends Model
{
    protected $table = 'nota_ingresos';

    protected function casts(): array
    {
        return [
            'fecha_desde' => 'date',
            'fecha_hasta' => 'date',
            'monto' => 'decimal:2',
        ];
    }

    public function banco(): BelongsTo
    {
        return $this->belongsTo(Banco::class);
    }

    public function tipoPago(): BelongsTo
    {
        return $this->belongsTo(TipoPago::class);
    }

    public function liquidacionOperador(): BelongsTo
    {
        return $this->belongsTo(LiquidacionOperador::class);
    }

    public function pago(): HasOne
    {
        return $this->hasOne(Pago::class);
    }
}
