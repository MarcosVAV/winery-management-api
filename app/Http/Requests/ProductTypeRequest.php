<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductTypeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:product_types,name', 'min:4'],
        ];
    }
}