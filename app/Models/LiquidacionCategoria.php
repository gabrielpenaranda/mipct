<?php

namespace App\Models;

use Database\Factories\LiquidacionCategoriaFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['codigo', 'nombre', 'descripcion'])]
class LiquidacionCategoria extends Model
{
    /** @use HasFactory<LiquidacionCategoriaFactory> */
    use HasFactory;

    protected $table = 'liquidacion_categorias';

    public function conceptos(): HasMany
    {
        return $this->hasMany(LiquidacionConcepto::class, 'liquidacion_categoria_id');
    }
}
