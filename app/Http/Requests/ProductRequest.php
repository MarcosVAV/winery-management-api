<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'product_type_id' => ['required', 'exists:product_types,id'],
            'weight' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'brand' =>  ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nome',
            'product_type_id' => 'Tipo de Produto',
            'weight' => 'Peso',
            'price' => 'Preço',
            'brand' => 'Marca',
        ];
    }
}