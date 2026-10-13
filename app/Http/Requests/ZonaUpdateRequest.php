<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ZonaUpdateRequest extends FormRequest
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
        $zona = $this->route('zona');

        return [
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('zonas', 'codigo')->ignore($zona->id ?? null),
            ],
            'nombre' => [
                'sometimes',
                'string',
                'min:3',
                'max:50',
                Rule::unique('zonas', 'nombre')->ignore($zona->id ?? null),
            ],
            'description' => [
                'nullable',
                'string',
                'min:3',
                'max:200',
            ],
        ];
    }
}
