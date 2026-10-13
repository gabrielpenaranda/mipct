<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PagoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pago = $this->route('pago');
        $bancoId = $this->input('banco_id') ?? $pago?->banco_id;

        return [
            'fecha' => [
                'sometimes',
                'date',
            ],
            'monto' => [
                'sometimes',
                'numeric',
                'min:0',
            ],
            'numero_recibo' => [
                'sometimes',
                'string',
                'min:1',
                'max:50',
                Rule::unique('pagos', 'numero_recibo')
                    ->ignore($pago->id ?? null)
                    ->where('banco_id', $bancoId),
            ],
            'banco_id' => [
                'sometimes',
                'integer',
                'exists:bancos,id',
            ],
            'tipo_pago_id' => [
                'sometimes',
                'integer',
                'exists:tipo_pagos,id',
            ],
        ];
    }
}
