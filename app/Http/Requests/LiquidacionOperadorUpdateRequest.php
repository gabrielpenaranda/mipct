<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LiquidacionOperadorUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $liquidacionOperador = $this->route('liquidacion_operador');

        return [
            'numero_liquidacion' => [
                'sometimes',
                'string',
                'min:3',
                'max:50',
                Rule::unique('liquidacion_operadores', 'numero_liquidacion')->ignore($liquidacionOperador->id ?? null),
            ],
            'concepto' => [
                'sometimes',
                'string',
                'min:3',
                'max:200',
            ],
            'recargo' => [
                'sometimes',
                'string',
                'min:3',
                'max:200',
            ],
            'multa' => [
                'sometimes',
                'string',
                'min:3',
                'max:200',
            ],
            'total_concepto' => [
                'sometimes',
                'numeric',
                'min:0',
            ],
            'total_recargo' => [
                'sometimes',
                'numeric',
                'min:0',
            ],
            'total_multa' => [
                'sometimes',
                'numeric',
                'min:0',
            ],
            'fecha' => [
                'sometimes',
                'date',
            ],
            'fecha_hasta' => [
                'sometimes',
                'date',
            ],
            'total_liquidacion' => [
                'sometimes',
                'numeric',
                'min:0',
            ],
            'es_pagado' => [
                'sometimes',
                'boolean',
            ],
            'operador_id' => [
                'sometimes',
                'integer',
                'exists:operadores,id',
            ],
            'user_id' => [
                'sometimes',
                'integer',
                'exists:users,id',
            ],
        ];
    }
}
