<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaIngresoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha_desde' => [
                'required',
                'date',
            ],
            'fecha_hasta' => [
                'required',
                'date',
                'after_or_equal:fecha_desde',
            ],
            'monto' => [
                'required',
                'numeric',
                'min:0',
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
            'liquidacion_operador_id' => [
                'required',
                'integer',
                'exists:liquidacion_operadores,id',
            ],
        ];
    }
}
