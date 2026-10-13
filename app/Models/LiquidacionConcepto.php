<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['nombre', 'descripcion', 'monto', 'codigo', 'linea_negocio_id', 'liquidacion_categoria_id'])]
class LiquidacionConcepto extends Model
{
    protected $table = 'liquidacion_conceptos';

    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
        ];
    }

    public function lineaNegocio(): BelongsTo
    {
        return $this->belongsTo(LineaNegocio::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(LiquidacionCategoria::class, 'liquidacion_categoria_id');
    }
}
