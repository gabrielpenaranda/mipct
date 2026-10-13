<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['nombre', 'codigo', 'description', 'es_asignado', 'zona_id'])]
class Territorio extends Model
{
    protected $table = 'territorios';

    protected function casts(): array
    {
        return [
            'es_asignado' => 'boolean',
        ];
    }

    public function zona(): BelongsTo
    {
        return $this->belongsTo(Zona::class);
    }

    public function inspectores(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'inspector_territorio', 'territorio_id', 'inspector_id');
    }
}
