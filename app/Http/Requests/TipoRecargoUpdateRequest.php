<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TipoRecargoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tipoRecargo = $this->route('tipo_recargo');

        return [
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('tipo_recargos', 'codigo')->ignore($tipoRecargo->id ?? null),
            ],
            'nombre' => [
                'sometimes',
                'string',
                'min:3',
                'max:100',
                Rule::unique('tipo_recargos', 'nombre')->ignore($tipoRecargo->id ?? null),
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
