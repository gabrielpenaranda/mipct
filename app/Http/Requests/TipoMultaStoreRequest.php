<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoMultaStoreRequest extends FormRequest
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
                'unique:tipo_multas,codigo',
            ],
            'nombre' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'unique:tipo_multas,nombre',
            ],
            'descripcion' => [
                'required',
                'string',
                'min:3',
                'max:200',
            ],
            'concepto' => [
                'required',
                'string',
                'min:3',
                'max:200',
            ],
            'monto' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }
}
