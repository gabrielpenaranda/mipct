<?php

namespace App\Models;

use App\Models\Scopes\FilterScope;
use App\Models\Scopes\IncludeScope;
use App\Models\Scopes\IncludeShowScope;
use App\Models\Scopes\SelectScope;
use App\Models\Scopes\SelectShowScope;
use App\Models\Scopes\SortScope;
use Database\Factories\CiudadFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nombre', 'codigo', 'provincia_id'])]
class Ciudad extends Model
{
    /** @use HasFactory<CiudadFactory> */
    use HasFactory;

    protected $table = 'ciudades';

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }

    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function scopeGetOrPaginate($query)
    {
        (new SelectScope)->apply($query, $query->getModel());
        (new SortScope)->apply($query, $query->getModel());
        (new FilterScope)->apply($query, $query->getModel());
        (new IncludeScope)->apply($query, $query->getModel());

        if (request('por_pagina')) {
            $perPage = (int) request('por_pagina');
            $page = request('pagina') ?: null;

            return $query->paginate($perPage, ['*'], 'page', $page);
        }

        return $query->get();
    }

    public function scopeShow(Builder $query): Builder
    {
        (new SelectShowScope)->apply($query, $query->getModel());
        (new IncludeShowScope)->apply($query, $query->getModel());

        return $query;
    }
}
