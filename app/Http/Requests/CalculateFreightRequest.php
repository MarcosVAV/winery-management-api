<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateFreightRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'delivery_distance_in_km' => ['required', 'numeric'],
            'products_id' => ['required', 'array'],
            'products_id.*' => ['required', 'exists:products,id', 'distinct'],
            'quantities' => ['required', 'array'],
            'quantities.*' => ['required', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'delivery_distance_in_km' => 'Distância da entrega',
            'products_id' => 'Produtos',
            'products_id.*' => 'Produto',
            'quantities' => 'Quantidades',
            'quantities.*' => 'Quantidade',
        ];
    }
}