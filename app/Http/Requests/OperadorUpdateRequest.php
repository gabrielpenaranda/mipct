<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OperadorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $operador = $this->route('operador');

        return [
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('operadores', 'codigo')->ignore($operador->id ?? null),
            ],
            'nombre_juridico' => [
                'sometimes',
                'string',
                'min:3',
                'max:100',
                Rule::unique('operadores', 'nombre_juridico')->ignore($operador->id ?? null),
            ],
            'correo_empresa' => [
                'sometimes',
                'string',
                'email',
                'max:100',
            ],
            'numero_documento' => [
                'sometimes',
                'string',
                'min:5',
                'max:30',
                Rule::unique('operadores', 'numero_documento')->ignore($operador->id ?? null),
            ],
            'tipo_persona' => [
                'sometimes',
                Rule::in(['juridica', 'natural']),
            ],
            'direccion' => [
                'sometimes',
                'string',
                'min:5',
                'max:200',
            ],
            'telefono' => [
                'nullable',
                'string',
                'min:5',
                'max:30',
            ],
            'ciudad_id' => [
                'sometimes',
                'integer',
                'exists:ciudades,id',
            ],
            'tipo_documento' => [
                'sometimes',
                'integer',
                'exists:tipo_documentos,id',
            ],
            'user_id' => [
                'sometimes',
                'integer',
                'exists:users,id',
            ],
            'tipo_servicio_id' => [
                'sometimes',
                'integer',
                'exists:tipo_servicios,id',
            ],
            'linea_negocio_id' => [
                'sometimes',
                'integer',
                'exists:linea_negocios,id',
            ],
        ];
    }
}
