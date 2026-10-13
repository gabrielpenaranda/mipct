<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BancoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $banco = $this->route('banco');

        return [
            'nombre' => [
                'sometimes',
                'string',
                'min:3',
                'max:100',
                Rule::unique('bancos', 'nombre')->ignore($banco->id ?? null),
            ],
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:20',
                Rule::unique('bancos', 'codigo')->ignore($banco->id ?? null),
            ],
        ];
    }
}
