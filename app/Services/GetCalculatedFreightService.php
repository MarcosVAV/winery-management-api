<?php

namespace App\Services;

use App\Models\Product;

class GetCalculatedFreightService
{
    public function run(object $requestData): int
    {
        $totalWeight = 0;

        $delivery_distance = $requestData->delivery_distance_in_km;

        $products = Product::whereIn('id', $requestData->products_id)->get();

        foreach ($products as $key => $product) {
            $totalWeight += $product->weight * $requestData->quantities[$key];
        }

        if ($delivery_distance <= 100) {
            $freightValue = (int) $totalWeight * 5;
        } else {
            $freightValue = (int) ($totalWeight * $delivery_distance / 100) * 5;
        }

        return $freightValue;
    }
}