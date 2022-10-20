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
            return response()->json(['Erro ao cadastrar o produto!'], 400);
        }

        return response()->json(['Produto cadastrado com sucesso!']);
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
            return response()->json(['Erro ao atualizar o produto!'], 400);
        }

        return response()->json(['Produto atualizado com sucesso!']);
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (\Throwable $th) {
            return response()->json(['Erro ao deletar o produto!'], 400);
        }

        return response()->noContent();
    }
}