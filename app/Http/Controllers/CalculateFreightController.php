<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateFreightRequest;
use App\Services\GetCalculatedFreightService;
use App\Services\ValidateTheCountOfProductsAndQuantitiesService;

class CalculateFreightController extends Controller
{
    public function __construct(
        protected ValidateTheCountOfProductsAndQuantitiesService $validateTheCountOfProductsAndQuantitiesService,
        protected GetCalculatedFreightService $getCalculatedFreightService
    ) {
    }

    public function __invoke(CalculateFreightRequest $request)
    {
        $this->validateTheCountOfProductsAndQuantitiesService->run((object) $request->validated());

        $freightValue = $this->getCalculatedFreightService->run((object) $request->validated());

        return response()->json(compact('freightValue'));
    }
}