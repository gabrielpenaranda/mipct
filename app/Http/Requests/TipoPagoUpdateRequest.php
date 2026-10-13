<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TipoPagoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tipoPago = $this->route('tipo_pago');

        return [
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('tipo_pagos', 'codigo')->ignore($tipoPago->id ?? null),
            ],
            'nombre' => [
                'sometimes',
                'string',
                'min:3',
                'max:100',
                Rule::unique('tipo_pagos', 'nombre')->ignore($tipoPago->id ?? null),
            ],
        ];
    }
}
