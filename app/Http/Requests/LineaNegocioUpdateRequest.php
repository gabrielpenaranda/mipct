<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LineaNegocioUpdateRequest extends FormRequest
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
        $lineaNegocio = $this->route('lineaNegocio');

        return [
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('linea_negocios', 'codigo')->ignore($lineaNegocio->id ?? null),
            ],
            'nombre' => [
                'sometimes',
                'string',
                'min:3',
                'max:50',
                Rule::unique('linea_negocios', 'nombre')->ignore($lineaNegocio->id ?? null),
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
