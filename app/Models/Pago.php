<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['fecha', 'monto', 'numero_recibo', 'banco_id', 'tipo_pago_id', 'nota_ingreso_id'])]
class Pago extends Model
{
    protected $table = 'pagos';

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
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

    public function notaIngreso(): BelongsTo
    {
        return $this->belongsTo(NotaIngreso::class);
    }
}
