<?php

namespace App\Services;

use App\Models\Product;

class GetCalculatedPriceService
{
    public function run(object $requestData): array
    {
        $subtotal = 0;

        $products = Product::whereIn('id', $requestData->products_id)->get();

        foreach ($products as $key => $product) {
            $subtotal += $product->price * $requestData->quantities[$key];
        }

        $discount = $subtotal * min($requestData->discount_percentage, 100) / 100;

        $totalPrice = $subtotal + $requestData->freight_value - $discount;

        return ['subtotal' => $subtotal, 'totalPrice' => $totalPrice];
    }
}