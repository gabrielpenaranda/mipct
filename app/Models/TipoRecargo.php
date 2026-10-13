<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nombre', 'descripcion', 'concepto', 'monto', 'codigo'])]
class TipoRecargo extends Model
{
    protected $table = 'tipo_recargos';

    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
        ];
    }

    public function liquidacionesRecargo(): HasMany
    {
        return $this->hasMany(LiquidacionRecargo::class);
    }
}
