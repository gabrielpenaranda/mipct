<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProvinciaUpdateRequest extends FormRequest
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
        $provincia = $this->route('provincia');

        return [
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('provincias', 'codigo')->ignore($provincia->id ?? null),
            ],
            'nombre' => [
                'sometimes',
                'string',
                'min:3',
                'max:50',
                Rule::unique('provincias', 'nombre')->ignore($provincia->id ?? null),
            ],
        ];
    }
}
