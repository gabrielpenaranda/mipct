<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiquidacionMultaStoreRequest extends FormRequest
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
                'unique:liquidacion_multas,codigo',
            ],
            'descripcion' => [
                'required',
                'string',
                'min:3',
                'max:200',
            ],
            'tipo_multa_id' => [
                'required',
                'integer',
                'exists:tipo_multas,id',
            ],
        ];
    }
}
