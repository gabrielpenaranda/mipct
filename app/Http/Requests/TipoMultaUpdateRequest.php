<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TipoMultaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tipoMulta = $this->route('tipo_multa');

        return [
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('tipo_multas', 'codigo')->ignore($tipoMulta->id ?? null),
            ],
            'nombre' => [
                'sometimes',
                'string',
                'min:3',
                'max:100',
                Rule::unique('tipo_multas', 'nombre')->ignore($tipoMulta->id ?? null),
            ],
            'descripcion' => [
                'sometimes',
                'string',
                'min:3',
                'max:200',
            ],
            'concepto' => [
                'sometimes',
                'string',
                'min:3',
                'max:200',
            ],
            'monto' => [
                'sometimes',
                'numeric',
                'min:0',
            ],
        ];
    }
}
