<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['codigo', 'descripcion', 'tipo_recargo_id', 'liquidacion_operador_id'])]
class LiquidacionRecargo extends Model
{
    protected $table = 'liquidacion_recargos';

    public function tipoRecargo(): BelongsTo
    {
        return $this->belongsTo(TipoRecargo::class);
    }

    public function liquidacionOperador(): BelongsTo
    {
        return $this->belongsTo(LiquidacionOperador::class);
    }
}
