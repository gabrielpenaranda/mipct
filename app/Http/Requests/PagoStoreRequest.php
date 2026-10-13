<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha' => [
                'required',
                'date',
            ],
            'monto' => [
                'required',
                'numeric',
                'min:0',
            ],
            'numero_recibo' => [
                'required',
                'string',
                'min:1',
                'max:50',
            ],
            'banco_id' => [
                'required',
                'integer',
                'exists:bancos,id',
            ],
            'tipo_pago_id' => [
                'required',
                'integer',
                'exists:tipo_pagos,id',
            ],
        ];
    }
}
