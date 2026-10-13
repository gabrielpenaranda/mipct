<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['nombre', 'tipo_documento_id', 'operador_id'])]
class OperadorDocumento extends Model
{
    protected $table = 'operador_documentos';

    public function tipoDocumento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }

    public function operador(): BelongsTo
    {
        return $this->belongsTo(Operador::class);
    }
}
