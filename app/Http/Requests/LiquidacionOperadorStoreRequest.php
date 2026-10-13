<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiquidacionOperadorStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numero_liquidacion' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'unique:liquidacion_operadores,numero_liquidacion',
            ],
            'concepto' => [
                'required',
                'string',
                'min:3',
                'max:200',
            ],
            'recargo' => [
                'required',
                'string',
                'min:3',
                'max:200',
            ],
            'multa' => [
                'required',
                'string',
                'min:3',
                'max:200',
            ],
            'total_concepto' => [
                'required',
                'numeric',
                'min:0',
            ],
            'total_recargo' => [
                'required',
                'numeric',
                'min:0',
            ],
            'total_multa' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fecha' => [
                'required',
                'date',
            ],
            'fecha_hasta' => [
                'required',
                'date',
            ],
            'total_liquidacion' => [
                'required',
                'numeric',
                'min:0',
            ],
            'es_pagado' => [
                'nullable',
                'boolean',
            ],
            'operador_id' => [
                'required',
                'integer',
                'exists:operadores,id',
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
        ];
    }
}
