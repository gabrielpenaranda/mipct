<?php

namespace App\Models;

use App\Models\Scopes\FilterScope;
use App\Models\Scopes\IncludeScope;
use App\Models\Scopes\IncludeShowScope;
use App\Models\Scopes\SelectScope;
use App\Models\Scopes\SelectShowScope;
use App\Models\Scopes\SortScope;
use App\Notifications\RestablecerContrasenaNotification;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['nombre', 'apellido', 'email', 'direccion', 'telefono', 'empresa', 'numero_documento', 'tipo_documento', 'carnet', 'es_activo', 'es_inspector', 'tipo', 'password', 'ciudad_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable, TwoFactorAuthenticatable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'es_activo' => 'boolean',
            'es_inspector' => 'boolean',
        ];
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new RestablecerContrasenaNotification($token));
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

    public function initials(): string
    {
        $nombre = trim($this->nombre ?? '');
        $apellido = trim($this->apellido ?? '');
        $name = $nombre.' '.$apellido;

        if (empty($name)) {
            return 'U'; // Fallback if the name is empty
        }

        $words = explode(' ', $name);
        $initials = '';

        foreach ($words as $word) {
            // mb_substr ensures it works safely with accented or multibyte characters
            $initials .= strtoupper(mb_substr($word, 0, 1));
        }

        // Return a maximum of 2 characters for a clean avatar appearance
        return mb_substr($initials, 0, 2);
    }

    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function territorios(): BelongsToMany
    {
        return $this->belongsToMany(Territorio::class, 'inspector_territorio', 'inspector_id', 'territorio_id');
    }
}
