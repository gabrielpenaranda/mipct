<?php

namespace App\Models;

use Database\Factories\ProvinciaFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nombre', 'codigo'])]
class Provincia extends Model
{
    /** @use HasFactory<ProvinciaFactory> */
    use HasFactory;

    protected $table = 'provincias';

    public function ciudades(): HasMany
    {
        return $this->hasMany(Ciudad::class);
    }
}
