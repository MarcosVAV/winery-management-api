<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTypeRequest;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index()
    {
        $productTypes = ProductType::orderBy('name')->get();

        return response()->json(compact('productTypes'));
    }

    public function store(ProductTypeRequest $request)
    {
        try {
            ProductType::create($request->validated());
        } catch (\Throwable $th) {
            return response()->json(['Erro ao cadastrar o Tipo de Produto!'], 400);
        }

        return response()->json(['Tipo de Produto cadastrado com sucesso!'], 201);
    }

    public function show(ProductType $productType)
    {
        return response()->json(compact('productType'));
    }

    public function update(ProductTypeRequest $request, ProductType $productType)
    {
        try {
            $productType->update($request->validated());
        } catch (\Throwable $th) {
            return response()->json(['Erro ao atualizar o Tipo de Produto!'], 400);
        }

        return response()->json(['Tipo de Produto atualizar com sucesso!']);
    }

    public function destroy(ProductType $productType)
    {
        try {
            $productType->delete();
        } catch (\Throwable $th) {
            return response()->json(['Erro ao deletar o Tipo de Produto!']);
        }

        return response()->noContent();
    }
}