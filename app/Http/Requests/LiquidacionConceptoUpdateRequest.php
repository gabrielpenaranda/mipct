<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LiquidacionConceptoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $liquidacionConcepto = $this->route('liquidacion_concepto');

        return [
            'codigo' => [
                'sometimes',
                'string',
                'min:2',
                'max:10',
                Rule::unique('liquidacion_conceptos', 'codigo')->ignore($liquidacionConcepto->id ?? null),
            ],
            'nombre' => [
                'sometimes',
                'string',
                'min:3',
                'max:100',
                Rule::unique('liquidacion_conceptos', 'nombre')->ignore($liquidacionConcepto->id ?? null),
            ],
            'descripcion' => [
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
            'linea_negocio_id' => [
                'sometimes',
                'integer',
                'exists:linea_negocios,id',
            ],
            'liquidacion_categoria_id' => [
                'sometimes',
                'integer',
                'exists:liquidacion_categorias,id',
            ],
        ];
    }
}
