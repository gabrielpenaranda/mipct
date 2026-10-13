<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OperadorStoreRequest extends FormRequest
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
        return [
            'codigo' => [
                'required',
                'string',
                'min:2',
                'max:10',
                'unique:operadores,codigo',
            ],
            'nombre_juridico' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'unique:operadores,nombre_juridico',
            ],
            'correo_empresa' => [
                'required',
                'string',
                'email',
                'max:100',
            ],
            'numero_documento' => [
                'required',
                'string',
                'min:5',
                'max:30',
                'unique:operadores,numero_documento',
            ],
            'tipo_persona' => [
                'required',
                Rule::in(['juridica', 'natural']),
            ],
            'direccion' => [
                'required',
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
                'required',
                'integer',
                'exists:ciudades,id',
            ],
            'tipo_documento' => [
                'required',
                'integer',
                'exists:tipo_documentos,id',
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'tipo_servicio_id' => [
                'required',
                'integer',
                'exists:tipo_servicios,id',
            ],
            'linea_negocio_id' => [
                'required',
                'integer',
                'exists:linea_negocios,id',
            ],
        ];
    }
}
