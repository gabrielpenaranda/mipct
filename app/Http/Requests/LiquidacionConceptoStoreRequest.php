<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiquidacionConceptoStoreRequest extends FormRequest
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
                'unique:liquidacion_conceptos,codigo',
            ],
            'nombre' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'unique:liquidacion_conceptos,nombre',
            ],
            'descripcion' => [
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
            'linea_negocio_id' => [
                'required',
                'integer',
                'exists:linea_negocios,id',
            ],
            'liquidacion_categoria_id' => [
                'required',
                'integer',
                'exists:liquidacion_categorias,id',
            ],
        ];
    }
}
