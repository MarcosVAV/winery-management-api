<?php

namespace App\Services\SalesOrder;

use App\Exceptions\AppException;
use App\Models\SalesOrder;
use App\Services\ValidateTheCountOfProductsAndQuantitiesService;
use Illuminate\Support\Facades\DB;

class DeleteSalesOrderService
{
    public function __construct(
        protected ValidateTheCountOfProductsAndQuantitiesService $validateTheCountOfProductsAndQuantitiesService
    ) {
    }

    public function run(SalesOrder $salesOrder): void
    {
        DB::beginTransaction();

        try {
            $salesOrder->products()->detach();

            $salesOrder->delete();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new AppException('', 400, ['Erro ao deletar o Pedido de Venda!']);
        }

        DB::commit();
    }
}