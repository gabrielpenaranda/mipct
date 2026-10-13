<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'codigo',
    'nombre_juridico',
    'correo_empresa',
    'numero_documento',
    'tipo_persona',
    'direccion',
    'telefono',
    'ciudad_id',
    'tipo_documento',
    'user_id',
    'tipo_servicio_id',
    'linea_negocio_id',
])]
class Operador extends Model
{
    protected $table = 'operadores';

    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function tipoDocumento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tipoServicio(): BelongsTo
    {
        return $this->belongsTo(TipoServicio::class, 'tipo_servicio_id');
    }

    public function lineaNegocio(): BelongsTo
    {
        return $this->belongsTo(LineaNegocio::class, 'linea_negocio_id');
    }

    public function documentos(): HasMany
    {
        return $this->hasMany(OperadorDocumento::class);
    }
}
