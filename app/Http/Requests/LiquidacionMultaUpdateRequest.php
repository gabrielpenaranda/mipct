<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LiquidacionMultaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $liquidacionMulta = $this->route('liquidacion_multa');

        return [
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('liquidacion_multas', 'codigo')->ignore($liquidacionMulta->id ?? null),
            ],
            'descripcion' => [
                'sometimes',
                'string',
                'min:3',
                'max:200',
            ],
            'tipo_multa_id' => [
                'sometimes',
                'integer',
                'exists:tipo_multas,id',
            ],
        ];
    }
}
