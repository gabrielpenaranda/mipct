<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['codigo', 'descripcion', 'tipo_multa_id', 'liquidacion_operador_id'])]
class LiquidacionMulta extends Model
{
    protected $table = 'liquidacion_multas';

    public function tipoMulta(): BelongsTo
    {
        return $this->belongsTo(TipoMulta::class);
    }

    public function liquidacionOperador(): BelongsTo
    {
        return $this->belongsTo(LiquidacionOperador::class);
    }
}
