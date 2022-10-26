<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculatePriceRequest;
use App\Services\GetCalculatedPriceService;
use App\Services\ValidateTheCountOfProductsAndQuantitiesService;

class CalculatePriceController extends Controller
{
    public function __construct(
        protected ValidateTheCountOfProductsAndQuantitiesService $validateTheCountOfProductsAndQuantitiesService,
        protected GetCalculatedPriceService $getCalculatedPriceService
    ) {
    }

    public function __invoke(CalculatePriceRequest $request)
    {
        $this->validateTheCountOfProductsAndQuantitiesService->run((object) $request->validated());

        $totalPrice = $this->getCalculatedPriceService->run((object) $request->validated());

        return response()->json($totalPrice);
    }
}