<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TipoDocumentoStoreRequest extends FormRequest
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
            'nombre' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'unique:tipo_documentos,nombre',
            ],
            'codigo' => [
                'required',
                'string',
                'min:2',
                'max:10',
                'unique:tipo_documentos,codigo',
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
