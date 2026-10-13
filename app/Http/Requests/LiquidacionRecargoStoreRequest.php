<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiquidacionRecargoStoreRequest extends FormRequest
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
                'unique:liquidacion_recargos,codigo',
            ],
            'descripcion' => [
                'required',
                'string',
                'min:3',
                'max:200',
            ],
            'tipo_recargo_id' => [
                'required',
                'integer',
                'exists:tipo_recargos,id',
            ],
        ];
    }
}
