<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculatePriceRequest extends FormRequest
{
    public function prepareForValidation(): array
    {
        return [
            $this->merge(['discount_percentage' => (float) $this->discount_percentage])
        ];
    }

    public function rules(): array
    {
        return [
            'products_id' => ['required', 'array'],
            'products_id.*' => ['required', 'exists:products,id', 'distinct'],
            'quantities' => ['required', 'array'],
            'quantities.*' => ['required', 'integer'],
            'freight_value' => ['required', 'numeric', 'min:0'],
            'discount_percentage' => ['required', 'numeric', 'min:0']
        ];
    }

    public function attributes(): array
    {
        return [
            'products_id' => 'Produtos',
            'products_id.*' => 'Produto',
            'quantities' => 'Quantidades',
            'quantities.*' => 'Quantidade',
            'freight_value.*' => 'Valor do frete',
        ];
    }
}