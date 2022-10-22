<?php

namespace App\Services;

use App\Exceptions\AppException;

class ValidateTheCountOfProductsAndQuantitiesService
{
    public function run(object $requestData): void
    {
        throw_if(
            count($requestData->products_id) != count($requestData->quantities),
            new AppException('Os produtos e suas respectivas quantidades devem ser preenchidas!')
        );
    }
}