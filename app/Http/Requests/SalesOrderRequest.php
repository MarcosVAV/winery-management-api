<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesOrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'delivery_distance_in_km' => ['required', 'numeric'],
            'products_id' => ['required', 'array'],
            'products_id.*' => ['required', 'exists:products,id', 'distinct'],
            'quantities' => ['required', 'array'],
            'quantities.*' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
            'discount_percentage' => ['nullable', 'numeric'],
            'expected_date' => ['nullable', 'date'],
            'freight_value' => ['required', 'numeric'],
            'subtotal' => ['required', 'numeric', 'min:1'],
            'total_price' => ['required', 'numeric', 'min:1'],
        ];
    }

    public function attributes(): array
    {
        return [
            'total_price' => 'Preço total',
            'freight_value' => 'Valor do frete',
            'delivery_distance_in_km' => 'Distância da entrega',
            'products_id' => 'Produtos',
            'products_id.*' => 'Produto',
            'quantities' => 'Quantidades',
            'quantities.*' => 'Quantidade',
            'description' => 'Descrição',
            'discount_percentage' => 'Percentual de desconto',
            'expected_date' => 'Data prevista'
        ];
    }
}