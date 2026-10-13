<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LiquidacionRecargoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $liquidacionRecargo = $this->route('liquidacion_recargo');

        return [
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('liquidacion_recargos', 'codigo')->ignore($liquidacionRecargo->id ?? null),
            ],
            'descripcion' => [
                'sometimes',
                'string',
                'min:3',
                'max:200',
            ],
            'tipo_recargo_id' => [
                'sometimes',
                'integer',
                'exists:tipo_recargos,id',
            ],
        ];
    }
}
