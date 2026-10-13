<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TipoDocumentoUpdateRequest extends FormRequest
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
        $tipoDocumento = $this->route('tipoDocumento');

        return [
            'nombre' => [
                'sometimes',
                'string',
                'min:3',
                'max:30',
                Rule::unique('tipo_documentos', 'nombre')->ignore($tipoDocumento->id ?? null),
            ],
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('tipo_documentos', 'codigo')->ignore($tipoDocumento->id ?? null),
            ],
            'descripcion' => [
                'nullable',
                'string',
                'min:3',
                'max:200',
            ],
        ];
    }
}
