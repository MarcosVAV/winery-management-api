<?php

namespace App\Services\SalesOrder;

use App\Exceptions\AppException;
use App\Models\SalesOrder;
use App\Services\ValidateTheCountOfProductsAndQuantitiesService;
use Illuminate\Support\Facades\DB;

class UpdateSalesOrderService
{
    public function __construct(
        protected ValidateTheCountOfProductsAndQuantitiesService $validateTheCountOfProductsAndQuantitiesService
    ) {
    }

    public function run(array $requestData, SalesOrder $salesOrder): void
    {
        $this->validateTheCountOfProductsAndQuantitiesService->run((object) $requestData);

        DB::beginTransaction();

        try {
            $salesOrder->products()->detach();

            $salesOrder->update($requestData);

            foreach ($requestData['products_id'] as $key => $product_id) {
                $salesOrder->products()->attach($product_id, ['quantity' => $requestData['quantities'][$key]]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new AppException('', 400, ['Erro ao atualizar o Pedido de Venda!']);
        }

        DB::commit();
    }
}