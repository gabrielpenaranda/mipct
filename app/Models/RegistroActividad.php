<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistroActividad extends Model
{
    protected $table = 'registro_actividades';

    protected $fillable = [
        'nombre_tabla',
        'accion',
        'tabla_id',
        'user_id',
    ];

    public static function registro(string $nombreTabla, string $accion, int $tablaId, int $userId): void
    {
        self::create([
            'nombre_tabla' => $nombreTabla,
            'accion' => $accion,
            'tabla_id' => $tablaId,
            'user_id' => $userId,
        ]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withDefault(['name' => 'Usuario eliminado']);
    }
}
