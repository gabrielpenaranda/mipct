<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['codigo', 'nombre', 'descripcion'])]
class LineaNegocio extends Model
{
    protected $table = 'linea_negocios';

    public function operadores(): HasMany
    {
        return $this->hasMany(Operador::class);
    }

    public function liquidacionConceptos(): HasMany
    {
        return $this->hasMany(LiquidacionConcepto::class);
    }
}
