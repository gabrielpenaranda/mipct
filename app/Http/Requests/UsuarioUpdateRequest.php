<?php

namespace App\Http\Requests;

use App\Enums\TipoDocumento;
use App\Enums\UsuarioTipo;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $usuario = $this->route('usuario');
        $tipo = $this->input('tipo', $usuario->tipo);
        $esFuncionario = $tipo === UsuarioTipo::funcionario->value;

        return [
            'nombre' => 'sometimes|string|min:3|max:30',
            'apellido' => 'sometimes|string|min:3|max:40',
            'empresa' => [
                Rule::when(! $esFuncionario, [
                    'sometimes',
                    'string',
                    'min:3',
                    'max:150',
                    Rule::unique('users', 'empresa')->ignore($usuario->id ?? null),
                ]),
            ],
            'email' => [
                'sometimes',
                'email',
                'min:10',
                'max:40',
                Rule::unique('users', 'email')->ignore($usuario->id ?? null),
            ],
            'direccion' => 'sometimes|string|min:10|max:200',
            'telefono' => 'nullable|string|max:50',
            'numero_documento' => [
                'sometimes',
                'string',
                'digits_between:5,15',
                Rule::unique('users', 'numero_documento')->ignore($usuario->id ?? null),
            ],
            'tipo_documento' => [
                'sometimes',
                'string',
                Rule::enum(TipoDocumento::class),
            ],
            'carnet' => [
                Rule::when($esFuncionario, [
                    'sometimes',
                    'string',
                    'digits_between:5,15',
                    Rule::unique('users', 'carnet')->ignore($usuario->id ?? null),
                ]),
            ],
            'es_inspector' => [
                Rule::when($esFuncionario, ['sometimes', 'boolean']),
            ],
            'es_activo' => 'sometimes|boolean',
            'tipo' => [
                'sometimes',
                Rule::enum(UsuarioTipo::class),
            ],
            'password' => 'sometimes|string|min:8|max:20',
            'ciudad_id' => 'sometimes|integer|exists:ciudades,id',
        ];
    }
}
