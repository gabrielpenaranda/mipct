<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TerritorioStoreRequest extends FormRequest
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
                'unique:territorios,codigo',
            ],
            'nombre' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'unique:territorios,nombre',
            ],
            'description' => [
                'nullable',
                'string',
                'min:3',
                'max:200',
            ],
            'es_asignado' => [
                'nullable',
                'boolean',
            ],
            'zona_id' => [
                'required',
                'integer',
                'exists:zonas,id',
            ],
        ];
    }
}
