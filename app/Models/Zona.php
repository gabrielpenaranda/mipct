<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nombre', 'codigo', 'description'])]
class Zona extends Model
{
    protected $table = 'zonas';

    public function territorios(): HasMany
    {
        return $this->hasMany(Territorio::class);
    }
}
