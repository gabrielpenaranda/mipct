<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nombre', 'codigo'])]
class TipoPago extends Model
{
    protected $table = 'tipo_pagos';

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }

    public function notasIngreso(): HasMany
    {
        return $this->hasMany(NotaIngreso::class);
    }
}
