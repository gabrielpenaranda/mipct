<?php

namespace App\Http\Requests;

use App\Enums\TipoDocumento;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthRegisterRequest extends FormRequest
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
        return [
            'nombre' => 'required|string|min:3|max:30',
            'apellido' => 'required|string|min:3|max:40',
            'empresa' => 'required|string|min:3|max:150|unique:users,empresa',
            'email' => 'required|email|min:10|max:40|unique:users,email',
            'direccion' => 'required|string|min:10|max:200',
            'telefono' => 'nullable|string|max:50',
            'numero_documento' => 'required|string|digits_between:5,15|unique:users,numero_documento',
            'tipo_documento' => [
                'required',
                'string',
                Rule::enum(TipoDocumento::class),
            ],
            'es_activo' => 'required|boolean',
            'password' => 'required|string|min:8|max:20',
            'ciudad_id' => 'required|integer|exists:ciudades,id',
        ];
    }
}
