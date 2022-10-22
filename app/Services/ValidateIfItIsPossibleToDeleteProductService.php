<?php

namespace App\Services;

use App\Exceptions\AppException;
use App\Models\Product;

class ValidateIfItIsPossibleToDeleteProductService
{
    public function run(Product $product): void
    {
        throw_if($product->salesOrders()->exists(), new AppException(
            '',
            400,
            ['Não foi possível deletar o produto!', 'Existe(m) pedido(s) de venda(s) para este produto!']
        ));
    }
}