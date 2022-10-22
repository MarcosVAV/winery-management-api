<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalesOrderRequest;
use App\Models\SalesOrder;
use App\Services\SalesOrder\DeleteSalesOrderService;
use App\Services\SalesOrder\StoreSalesOrderService;
use App\Services\SalesOrder\UpdateSalesOrderService;

class SalesOrderController extends Controller
{
    public function __construct(
        protected StoreSalesOrderService $storeSalesOrderService,
        protected UpdateSalesOrderService $updateSalesOrderService,
        protected DeleteSalesOrderService $deleteSalesOrderService,
    ) {
    }

    public function index()
    {
        $salesOrders = SalesOrder::with('products')->get();

        return response()->json(compact('salesOrders'));
    }

    public function store(SalesOrderRequest $request)
    {
        $this->storeSalesOrderService->run($request->validated());

        return response()->json(['Pedido de Venda cadastrado com sucesso!'], 201);
    }

    public function show(SalesOrder $salesOrder)
    {
        return response()->json(compact('salesOrder'));
    }

    public function update(SalesOrderRequest $request, SalesOrder $salesOrder)
    {
        $this->updateSalesOrderService->run($request->validated(), $salesOrder);

        return response()->json(['Pedido de Venda atualizado com sucesso!']);
    }

    public function destroy(SalesOrder $salesOrder)
    {
        $this->deleteSalesOrderService->run($salesOrder);

        return response()->noContent();
    }
}