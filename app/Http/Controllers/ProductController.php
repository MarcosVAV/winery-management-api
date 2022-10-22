<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return response()->json(compact('products'));
    }

    public function store(ProductRequest $request)
    {
        try {
            Product::create($request->validated());
        } catch (\Throwable $th) {
            return response()->json(['Erro ao cadastrar o Produto!'], 400);
        }

        return response()->json(['Produto cadastrado com sucesso!'], 201);
    }

    public function show(Product $product)
    {
        return response()->json(compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product->update($request->validated());
        } catch (\Throwable $th) {
            return response()->json(['Erro ao atualizar o Produto!'], 400);
        }

        return response()->json(['Produto atualizado com sucesso!']);
    }

    public function destroy(Product $product)
    {
        if ($product->salesOrders()->exists()) {
            return response()->json(
                [
                    'Não foi possível deletar o produto!',
                    'Existe(m) pedido(s) de venda(s) para este produto!'
                ],
                400
            );
        }

        try {
            $product->delete();
        } catch (\Throwable $th) {
            return response()->json(['Erro ao deletar o Produto!'], 400);
        }

        return response()->noContent();
    }
}