<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BancoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'unique:bancos,nombre',
            ],
            'codigo' => [
                'required',
                'string',
                'min:2',
                'max:20',
                'unique:bancos,codigo',
            ],
        ];
    }
}
