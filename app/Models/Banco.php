<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nombre', 'codigo'])]
class Banco extends Model
{
    protected $table = 'bancos';

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }

    public function notasIngreso(): HasMany
    {
        return $this->hasMany(NotaIngreso::class);
    }
}
