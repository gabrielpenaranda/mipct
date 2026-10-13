<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['codigo', 'nombre', 'descripcion'])]
class TipoDocumento extends Model
{
    protected $table = 'tipo_documentos';

    public function operadores(): HasMany
    {
        return $this->hasMany(Operador::class, 'tipo_documento');
    }

    public function operadorDocumentos(): HasMany
    {
        return $this->hasMany(OperadorDocumento::class, 'tipo_documento_id');
    }
}
