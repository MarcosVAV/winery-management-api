<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateFreightRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'delivery_distance_in_km' => ['required', 'numeric', 'min:1'],
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

    public function messages(): array
    {
        return [
            'delivery_distance_in_km.min' => 'O campo Distância da entrega deve ser no mínimo 1, caso tenha frete!'
        ];
    }
}