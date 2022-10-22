<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalesOrderRequest;
use App\Http\Requests\UpdateSalesOrderRequest;
use App\Models\SalesOrder;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    public function index()
    {
        $salesOrders = SalesOrder::with('products')->get();

        return response()->json(compact('salesOrders'));
    }

    public function store(SalesOrderRequest $request)
    {
        $requestData = $request->validated();

        if (count($requestData['products_id']) != count($requestData['quantities'])) {
            return response()->json(['Os produtos e suas respectivas quantidades devem ser preenchidas!'], 422);
        }

        DB::beginTransaction();

        try {
            $salesOrder = SalesOrder::create($requestData);

            foreach ($requestData['products_id'] as $key => $product_id) {
                $salesOrder->products()->attach($product_id, ['quantity' => $requestData['quantities'][$key]]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['Erro ao cadastrar o Pedido de Venda!'], 400);
        }

        DB::commit();

        return response()->json(['Pedido de Venda cadastrado com sucesso!'], 201);
    }

    public function show(SalesOrder $salesOrder)
    {
        return response()->json(compact('salesOrder'));
    }

    public function update(SalesOrderRequest $request, SalesOrder $salesOrder)
    {
        $requestData = $request->validated();

        if (count($requestData['products_id']) != count($requestData['quantities'])) {
            return response()->json(['Os produtos e suas respectivas quantidades devem ser preenchidas!'], 422);
        }

        DB::beginTransaction();

        try {
            $salesOrder->products()->detach();

            $salesOrder->update($requestData);

            foreach ($requestData['products_id'] as $key => $product_id) {
                $salesOrder->products()->attach($product_id, ['quantity' => $requestData['quantities'][$key]]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['Erro ao atualizar o Pedido de Venda!'], 400);
        }

        DB::commit();

        return response()->json(['Pedido de Venda atualizado com sucesso!']);
    }

    public function destroy(SalesOrder $salesOrder)
    {
        DB::beginTransaction();

        try {
            $salesOrder->products()->detach();

            $salesOrder->delete();
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['Erro ao deletar o Pedido de Venda!'], 400);
        }

        DB::commit();

        return response()->noContent();
    }
}