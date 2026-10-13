<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoPagoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'codigo' => [
                'required',
                'string',
                'min:2',
                'max:10',
                'unique:tipo_pagos,codigo',
            ],
            'nombre' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'unique:tipo_pagos,nombre',
            ],
        ];
    }
}
