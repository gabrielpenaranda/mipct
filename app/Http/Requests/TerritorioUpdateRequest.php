<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TerritorioUpdateRequest extends FormRequest
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
        $territorio = $this->route('territorio');

        return [
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('territorios', 'codigo')->ignore($territorio->id ?? null),
            ],
            'nombre' => [
                'sometimes',
                'string',
                'min:3',
                'max:50',
                Rule::unique('territorios', 'nombre')->ignore($territorio->id ?? null),
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
                'sometimes',
                'integer',
                'exists:zonas,id',
            ],
        ];
    }
}
