<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['codigo', 'nombre', 'descripcion'])]
class TipoServicio extends Model
{
    protected $table = 'tipo_servicios';

    public function operadores(): HasMany
    {
        return $this->hasMany(Operador::class);
    }
}
