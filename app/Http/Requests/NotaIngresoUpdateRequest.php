<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaIngresoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha_desde' => [
                'sometimes',
                'date',
            ],
            'fecha_hasta' => [
                'sometimes',
                'date',
                'after_or_equal:fecha_desde',
            ],
            'monto' => [
                'sometimes',
                'numeric',
                'min:0',
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
            'liquidacion_operador_id' => [
                'sometimes',
                'integer',
                'exists:liquidacion_operadores,id',
            ],
        ];
    }
}
