<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['codigo', 'nombre', 'descripcion', 'concepto', 'monto'])]
class TipoMulta extends Model
{
    protected $table = 'tipo_multas';

    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
        ];
    }

    public function liquidacionesMulta(): HasMany
    {
        return $this->hasMany(LiquidacionMulta::class);
    }
}
